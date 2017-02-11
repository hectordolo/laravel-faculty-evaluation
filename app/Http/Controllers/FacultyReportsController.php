<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\MigrateRecords;
use App\Models\GlobalVariables;
use App\Models\RoleUser;

use Auth;

class FacultyReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $user_ids = RoleUser::where('role_id', 5)
                ->pluck('user_id');

            $faculties = User::whereIn('id', $user_ids)
                ->paginate(50);

            return view('pages.reports.faculty.index', compact('faculties'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function view($id){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $faculty = User::find($id);


            return view('pages.reports.faculty.view', compact('faculty'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $user_ids = RoleUser::where('role_id', 5)
                ->pluck('user_id');

            $faculties = User::whereIn('id', $user_ids)
                ->orWhere('first_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('sjc_id', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_of', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_code', 'LIKE', '%'.$request->get('search').'%')
                ->paginate(50);

            return view('pages.reports.faculty.index', compact('faculties','user_ids'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
