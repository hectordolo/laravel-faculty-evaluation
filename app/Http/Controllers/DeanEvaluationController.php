<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentHeads;
use App\User;
use Carbon\Carbon;
use App\Models\Groups;
use App\Models\QuestionsFor;
use App\Models\GlobalVariables;
use App\Models\GroupsQuestions;

use Auth;

class DeanEvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->hasRole('faculty')){

            $heads = DepartmentHeads::where('faculty_id',$auth_user->id)
                ->get();

            return view('pages.dean.index', compact('heads'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function evaluate(DepartmentHeads $id)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole('faculty')){

            $head_evaluation = $id;

            $carbon = Carbon::now()->subHour(8);
            $time = $carbon->toDayDateTimeString();

            $semester = GlobalVariables::where('name','semester')->first();
            $school_year = GlobalVariables::where('name','school_year')->first();

            $for_dean = QuestionsFor::where('name', 'DEAN')
                ->first();

            $areas = Groups::where('for_id', $for_dean->id)
                ->orderBy('priority','asc')
                ->get();
            $questions = [];

            foreach ($areas as $area){
                $questions_data = GroupsQuestions::where('group_id',$area->id)
                    ->orderBy('priority','asc')
                    ->get();

                $questions[] = (object)['area'=>$area->name,
                    'area_id'=>$area->id,
                    'percentage'=>$area->percentage,
                    'questions'=>$questions_data];


            }

            return view('pages.dean.evaluate', compact('time','head_evaluation','questions','for_dean','areas','semester','school_year'));

        }else{

            return redirect()->route('four.zero.five');
        }

    }

    public function store(Request $request,DepartmentHeads $id){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole('faculty')){

            // inputs
            $sjc_id = $request->input('sjc_id');
            $trait_id = $request->input('trait_id');
            $area_id = $request->input('area_id');
            $trait_scores = $request->input('trait_score');
            $comments = $request->input('comments');

            // query record being evaluated
            $head_evaluation= $id;

            // getting specific area of evaluation
            $unique_area = array_unique ($area_id);

            // organizing evaluation answers into list
            foreach ($trait_id as $key=>$v){
                $trait_score[] = (object)['area_id'=>$area_id[$key],
                    'trait_id'=>$v,
                    'trait_score'=>$trait_scores[$key]];
            }

            //computing and storing evaluation answers
            $evaluation_answers = [];
            $over_all_total = [];

            foreach ($unique_area as $ua){
                $group = Groups::find($ua);

                $question_score = [];
                $evaluation_data = [];

                foreach ($trait_score as $ts){
                    if($ts->area_id == $ua){
                        array_push($question_score, $ts->trait_score);
                        array_push($over_all_total, $ts->trait_score);
                        $evaluation_data[] = ['question_id'=>$ts->trait_id,'question_score'=>$ts->trait_score];
                    }
                }

                $question_items = count($question_score);
                $sub_total = array_sum($question_score);
                $average = round(($sub_total/$question_items), 2);
                $area_rating = round(($average*(double)('0.'.$group->percentage)),2);

                $evaluation_answers[] = ['area_id' => $group->id,
                    'area_name' => $group->name,
                    'area_percentage' => $group->percentage,
                    'number_of_questions' => $question_items,
                    'sub_total' => $sub_total,
                    'average' => $average,
                    'area_rating' => $area_rating,
                    'evaluation_data' => $evaluation_data];
            }

            $evaluation[] = (object)['faculty_id'=>$auth_user->id,
                'semester'=>$semester->value,
                'school_year'=>$school_year->value,
                'dean_id'=> $head_evaluation->dean_id,
                'over_all_total'=> array_sum($over_all_total),
                'over_all_average'=> round((array_sum($over_all_total)/count($over_all_total)), 2),
                'evaluation_data'=>$evaluation_answers,
                'comments' => $comments];

            $evaluation_json = json_encode($evaluation);

            $head_evaluation->evaluation = $evaluation_json;
            $head_evaluation->status = '1';
            $head_evaluation->save();

            return redirect(route('deans.index'))->withSuccess('Your evaluation of the dean is successfully saved.');


        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
