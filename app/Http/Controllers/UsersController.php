<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\GlobalVariables;
use App\Requests\UserRequest;

use Auth;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){

            $users = User::paginate(50);

            return view('pages.users.index', compact('users'));
        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){
            $users = User::where('last_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('first_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('sjc_id', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('username', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('type', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_of', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_code', 'LIKE', '%'.$request->get('search').'%')
                ->paginate(25);

            return view('pages.users.index', compact('users'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function add(){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){

            $school_code = ['COLLEGE' => 'COLLEGE','GRADUATE' => 'GRADUATE','SHS' => 'SHS','BED' => 'BED'];
            $type = ['EMPLOYEE' => 'EMPLOYEE','STUDENT' => 'STUDENT'];

            $semester = GlobalVariables::where('name','semester')->first();
            $school_year = GlobalVariables::where('name','school_year')->first();

            $course = [];
            $school_of = [];

            return view('pages.users.add', compact('school_code', 'type','course','school_of','semester','school_year'));
        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function store(UserRequest $request)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){

            $user =  User::create($request->all());

            flash('The user account: '.$user->username.' is created.', 'success');
            return redirect()->route('users.index');

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function edit(User $user){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){

            $school_code = ['COLLEGE' => 'COLLEGE','GRADUATE' => 'GRADUATE','SHS' => 'SHS','BED' => 'BED'];
            $type = ['EMPLOYEE' => 'EMPLOYEE','STUDENT' => 'STUDENT'];

            $semester = GlobalVariables::where('name','semester')->first();
            $school_year = GlobalVariables::where('name','school_year')->first();

            $course = [];
            $school_of = [];

            return view('pages.users.edit', compact('user','school_code', 'type','course','school_of','semester','school_year'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function update(UserRequest $request, User $user)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){

            $user = $user;

            $user->update($request->has('password') ? $request->all() : $request->except(['password']));

            flash('The user account: '.$user->username.' is updated.', 'success');
            return redirect()->route('users.index');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(User $user)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){
            $user->delete();

            flash('The user account: '.$user->username.' is deleted.', 'danger');
            return redirect()->route('users.index');

        }else{
            return redirect()->route('four.zero.five');
        }

    }


}
