<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator, users-manager','users-read')){

            $employees = User::where('type','employee')
                ->paginate(50);

            return view('pages.users.employees.index', compact('employees'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(User $employee)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator, users-manager','users-delete')){
            $employee = $employee;
            $employee->delete();

            return redirect(route('employees.index'))->withSuccess('The employee: '.$employee->last_name.' is successfully deleted.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator, users-manager','users-read')){
            $employees = User::where('last_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('first_name', 'LIKE', '%'.$request->get('search').'%')
                ->paginate(50);

            return view('pages.users.employees.index', compact('employees'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
