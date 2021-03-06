<?php

namespace App\Http\Controllers;

use App\Requests\GroupRequest;
use Illuminate\Http\Request;
use App\Models\Groups;
use App\Models\QuestionsFor;

use Auth;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-read')){

            $groups = Groups::paginate(50);

            return view('pages.groups.index', compact('groups'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function add(){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-create')){

            $for = QuestionsFor::pluck('name', 'id');
            return view('pages.groups.add', compact('for'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function edit(Groups $group){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-update')){

            $group = $group;
            $for = QuestionsFor::pluck('name', 'id');
            return view('pages.groups.edit', compact('group','for'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function store(GroupRequest $request){
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-create')){

            $group = Groups::create($request->all());

            return redirect(route('groups.index'))->withSuccess('The group: '.$group->name.' is successfully added.');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function update(GroupRequest $request, Groups $group)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-update')){

            $group = $group;
            $group->update($request->all());

            return redirect(route('groups.index'))->withSuccess('The group: '.$group->name.' is successfully updated.');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(Groups $group)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-delete')){
            $group = $group;
            $group->delete();

            return redirect(route('groups.index'))->withSuccess('The group: '.$group->name.' is successfully deleted.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-read')){
            $groups = Groups::where('name', 'LIKE', '%'.$request->get('search').'%')
                ->paginate(50);

            return view('pages.groups.index', compact('groups'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
