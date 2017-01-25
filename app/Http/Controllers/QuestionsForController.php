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
            return view('pages.questions_for.edit', compact('for'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function store(QuestionForRequest $request){
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-for-create')){
            $question_for = QuestionsFor::create($request->all());

            return redirect(route('for.index'))->withSuccess('The question for: '.$question_for->name.' is successfully added.');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function update(QuestionForRequest $request, QuestionsFor $for)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-update')){

            $for = $for;
            $for->update($request->all());

            return redirect(route('for.index'))->withSuccess('The question for: '.$for->name.' is successfully updated.');
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(QuestionsFor $for)
    {
        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator','questions-delete')){

            $for = $for;
            $for->delete();

            return redirect(route('for.index'))->withSuccess('The question for: '.$for->name.' is successfully deleted.');
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
