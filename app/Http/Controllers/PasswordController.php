<?php

namespace App\Http\Controllers;

use App\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

use Auth;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(){

        return view('pages.users.password.edit');
    }

    public function update(Request $request){

        $user = Auth::user();

        if(Hash::check($request->input('current_password'), $user->password)){

            $user->update($request->except(['sjc_id','first_name','last_name', 'user_name']));

            flash('Your new password has been saved.', 'success');
            return redirect()->route('index');

        }else{

            flash('You entered the wrong current password.', 'danger');
            return redirect()->route('password.edit');
        }
    }
}
