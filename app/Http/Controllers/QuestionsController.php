<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Requests\QuestionRequest;
use App\Models\Questions;
use App\Models\QuestionsFor;
use Auth;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-read')){

            $questions = Questions::paginate(50);

            return view('pages.questions.index', compact('questions'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function add(){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-create')){

            $for = QuestionsFor::pluck('name', 'id');
            return view('pages.questions.add', compact('for'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function edit(Questions $question){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-update')){

            $question = $question;

            $for = QuestionsFor::pluck('name', 'id');
            return view('pages.questions.edit', compact('question', 'for'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function store(QuestionRequest $request){
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-create')){
            $question = Questions::create($request->all());

            return redirect(route('questions.index'))->withSuccess('The question: '.$question->name.' is successfully added.');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function update(QuestionRequest $request, Questions $question)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-update')){
            $old = $question;
            $question->update($request->all());

            return redirect(route('questions.index'))->withSuccess('The question: '.$question->name.' is successfully updated.');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(Questions $question)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-delete')){
            $old = $question;
            $question->delete();

            return redirect(route('questions.index'))->withSuccess('The question: '.$question->name.' is successfully deleted.');
        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-read')){
            $questions = Questions::where('name', 'LIKE', '%'.$request->get('search').'%')
                ->paginate(50);

            return view('pages.questions.index', compact('questions'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
