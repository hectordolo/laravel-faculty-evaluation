<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentHeads;
use App\Models\GlobalVariables;
use App\Models\RoleUser;

use Auth;

class AssignHeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($user){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole(['system-administrator','user-manager'])){

            $selected = [];

            $all_heads = DepartmentHeads::where('faculty_id',$user)
                ->get();

            if(!empty($all_heads)){
                foreach ($all_heads as $all_head){
                    $selected[] = $all_head->dean_id;
                }
            }

            $heads = RoleUser::where('role_id', 4)
                ->get();

            return view('pages.users.assign_head.index', compact('heads', 'selected','user'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function store($user, $dean){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])) {

                $faculty_head = DepartmentHeads::insert([
                    'faculty_id' => $user,
                    'dean_id' => $dean,
                    'status' => '0'
                ]);

            return redirect(route('assign.index',$user))->withSuccess('Department head assignment has been updated.');
            //return redirect(route('users.index'))->withSuccess('Department head assignment has been updated.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function delete($user, $dean){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])) {

            $faculty_head = DepartmentHeads::where('faculty_id', $user)
                ->where('dean_id', $dean)
                ->delete();

            return redirect(route('assign.index',$user))->withSuccess('Department head is removed.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }
}
