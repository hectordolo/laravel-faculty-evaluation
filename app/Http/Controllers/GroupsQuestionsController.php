<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests\GroupsQuestionsRequest;
use App\Models\GroupsQuestions;
use App\Models\Groups;
use App\Models\Questions;

use Auth;

class GroupsQuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($group_id){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-read')){

            $group = Groups::find($group_id);

            $groups_questions = GroupsQuestions::where('group_id', $group->id)
                ->orderBy('priority', 'asc')
                ->paginate(20);

            return view('pages.groups_questions.index', compact('groups_questions', 'group'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function add($group_id){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-create')){

            $group = Groups::find($group_id);

            $current_questions = GroupsQuestions::where('group_id', $group_id)
                ->select('question_id')
                ->get();

            $available_questions = Questions::whereNotIn('id', $current_questions)
                ->get();

            return view('pages.groups_questions.add', compact('available_questions', 'group'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function store(GroupsQuestionsRequest $request){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-create')){
            $group_id = $request->get('group_id');

            $questions_id = $request->get('questions_id');

            $count = 0;

            foreach($questions_id as $v){
                $questions = GroupsQuestions::create([
                    'group_id' => $group_id,
                    'question_id' => $v,
                    'priority' => '0'
                ]);

                $count = $count+1;
            }

            return redirect(route('groups_questions.index', $group_id))->withSuccess($count.' question(s) have been added.');
        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function destroy(GroupsQuestions $group_question)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-group-delete')){

            $group_question = $group_question;

            $group_question->delete();

            return redirect(route('groups_questions.index',$group_question->group_id))->withSuccess('The question: '.$group_question->question->name.' is successfully deleted from the group.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }
}
