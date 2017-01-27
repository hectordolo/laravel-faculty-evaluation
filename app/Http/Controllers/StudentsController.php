<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator, users-manager','users-read')){

            $students = User::where('type','STUDENT')
                ->paginate(50);

            return view('pages.users.students.index', compact('students'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(User $student)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator, users-manager','users-delete')){
            $student = $student;
            $student->delete();

            return redirect(route('students.index'))->withSuccess('The student: '.$student->last_name.' is successfully deleted.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator, users-manager','users-read')){
            $students = User::where('last_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('first_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_code', 'LIKE', '%'.$request->get('search').'%')
                ->where('type','STUDENT')
                ->paginate(50);

            return view('pages.users.students.index', compact('students'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
