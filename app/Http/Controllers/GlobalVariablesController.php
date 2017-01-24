<?php

namespace App\Http\Controllers;

use App\Requests\GlobalVariablesRequest;
use Illuminate\Http\Request;
use App\Models\GlobalVariables;

use Auth;

class GlobalVariablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $global_variables = GlobalVariables::paginate(50);

            return view('pages.global_variables.index', compact('global_variables'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function add(){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            return view('pages.global_variables.add');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function edit(GlobalVariables $global_variable){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $global_variable = $global_variable;
            return view('pages.global_variables.edit', compact('global_variable'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function store(GlobalVariablesRequest $request){
        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $global_variable = GlobalVariables::create($request->all());

            flash('The global variable: '.isset($global_variable->name)?$global_variable->name:$global_variable->name.' is successfully added.', 'success');
            return redirect()->route('global_variables.index');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function update(GlobalVariablesRequest $request, GlobalVariables $global_variable)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $old = $global_variable;
            $global_variable->update($request->all());

            flash('The global variable: '.isset($old->name)?$old->name:$old->name.' is successfully updated.', 'success');
            return redirect()->route('global_variables.index');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(GlobalVariables $global_variable)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){
            $old = $global_variable;
            $global_variable->delete();

            flash('The global variable: '.isset($old->name)?$old->name:$old->name.' is successfully deleted.', 'danger');
            return redirect()->route('global_variables.index');
        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){
            $global_variables = GlobalVariables::where('name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('value', 'LIKE', '%'.$request->get('search').'%')
                ->paginate(50);

            return view('pages.global_variables.index', compact('global_variables'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
