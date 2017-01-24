<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Requests\QuestionForRequest;
use App\Models\QuestionsFor;
use Auth;

class QuestionsForController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-for-read')){

            $questions_for = QuestionsFor::paginate(50);

            return view('pages.questions_for.index', compact('questions_for'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function add(){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-for-create')){

            return view('pages.questions_for.add');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function edit(QuestionsFor $for){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-for-update')){

            $for = $for;
            return view('pages.questions.edit', compact('for'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function store(QuestionForRequest $request){
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-for-create')){
            $question_for = QuestionsFor::create($request->all());

            flash('The question for: '.isset($question_for->name)?$question_for->name:$question_for->name.' is successfully added.', 'success');
            return redirect()->route('for.index');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function update(QuestionForRequest $request, QuestionsFor $for)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-update')){
            $old = $for;
            $for->update($request->all());

            flash('The question for: '.isset($for->name)?$for->name:$for->name.' is successfully updated.', 'success');
            return redirect()->route('questions.index');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(QuestionsFor $for)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-delete')){
            $old = $for;
            $for->delete();

            flash('The question for: '.isset($for->name)?$for->name:$for->name.' is successfully deleted.', 'danger');
            return redirect()->route('questions_for.index');
        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-read')){
            $questions_for = QuestionsFor::where('name', 'LIKE', '%'.$request->get('search').'%')
                ->paginate(50);

            return view('pages.questions_for.index', compact('questions_for'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
