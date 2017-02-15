<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Models\HasRole;

use Auth;

class HasRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $id){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){

            $user = $id;

            $selected = [];

            $all_roles = HasRole::where('user_id',$user->id)
                ->get();

            if(!empty($all_roles)){
                foreach ($all_roles as $all_role){
                    $selected[] = $all_role->role_id;
                }
            }

            $roles = Role::all('display_name','id');

            return view('pages.users.roles.edit', compact('user','roles','selected'));

        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function update(Request $request, User $user){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','user-manager'])){

            $user = $user;

            $lists = $request->input('roles');

            $remove_roles = HasRole::where('user_id', $user->id)
                ->delete();

            if(!empty($lists)){
                foreach ($lists as $list){
                    $user->attachRole($list);
                }
            }

            flash("The role of user: ".isset($user->display_name)?$user->display_name:$user->name.' is successfully updated.', 'success');
            return redirect()->route('has_roles.edit', $user->id);
        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
