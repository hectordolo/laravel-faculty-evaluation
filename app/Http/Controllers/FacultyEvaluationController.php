<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\GroupsQuestions;
use Illuminate\Http\Request;

use App\Models\MigrateRecords;
use App\Models\GlobalVariables;
use App\User;
use Carbon\Carbon;
use App\Models\QuestionsFor;

use Auth;

class FacultyEvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole('student')){

            $raw_data = MigrateRecords::where('semester', $semester->value)
                ->where('school_year', $school_year->value)
                ->where('sjc_id',$auth_user->sjc_id)
                ->get();

            $faculties =[];

            foreach ($raw_data as $value){
                if(!empty($value->employee_code)){
                    $faculty = User::where('sjc_id', $value->employee_code)
                        ->first();

                    if(!empty($faculty)){
                        $faculties[]=(object)['migration_record_id' => $value->id,
                            'sjc_id'=> $faculty->sjc_id,
                            'employee_name'=>$faculty->last_name.', '.$faculty->first_name,
                            'school_of'=>$faculty->school_of,
                            'subject_code'=>$value->subject_code,
                            'section_code'=>$value->section_code,
                            'faculty'=>'Yes',
                            'status'=>$value->status
                        ];
                    }else{
                        $faculties[]=(object)[
                            'migration_record_id' => $value->id,
                            'sjc_id'=> $value->employee_code,
                            'employee_name'=>$value->employee_name,
                            'school_of'=>'Empty',
                            'subject_code'=>$value->subject_code,
                            'section_code'=>$value->section_code,
                            'faculty'=>'Yes',
                            'status'=>$value->status];
                    }
                }else{
                    $faculties[]=(object)[
                        'migration_record_id' => $value->id,
                        'sjc_id'=> '',
                        'employee_name'=>'',
                        'school_of'=>'',
                        'subject_code'=>$value->subject_code,
                        'section_code'=>$value->section_code,
                        'faculty'=>'No',
                        'status'=>$value->status];
                }
            }

            return view('pages.student.index', compact('faculties','auth_user'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function evaluate($migration_record_id)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole('student')){

            $migrate_record = MigrateRecords::find($migration_record_id);

            $faculty = User::where('sjc_id', $migrate_record->employee_code)
                ->first();

            $carbon = Carbon::now()->subHour(8);
            $time = $carbon->toDayDateTimeString();

            $for_faculty = QuestionsFor::where('name', 'FACULTY')
                ->first();

            $areas = Groups::where('for_id', $for_faculty->id)
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

            return view('pages.student.evaluate', compact('faculty','time','migrate_record','for_faculty','questions'));

        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function store(Request $request,$subject_code,$section_code){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole('student')){

            // inputs
            $sjc_id = $request->input('sjc_id');
            $trait_id = $request->input('trait_id');
            $area_id = $request->input('area_id');
            $trait_scores = $request->input('trait_score');
            $comments = $request->input('comments');

            // query record being evaluated
            $migration_record = MigrateRecords::where('semester',$semester->value)
                ->where('school_year',$school_year->value)
                ->where('sjc_id',$auth_user->sjc_id)
                ->where('subject_code',$subject_code)
                ->where('section_code',$section_code)
                ->first();

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
            $total_observation_rating = [];

            foreach ($unique_area as $ua){
                $group = Groups::find($ua);

                $question_score = [];
                $evaluation_data = [];

                foreach ($trait_score as $ts){
                    if($ts->area_id == $ua){
                        array_push($question_score, $ts->trait_score);
                        $evaluation_data[] = ['question_id'=>$ts->trait_id,'question_score'=>$ts->trait_score];
                    }
                }

                $question_items = count($question_score);
                $sub_total = array_sum($question_score);
                $average = round(($sub_total/$question_items), 2);;
                $area_rating = round(($average*(double)('0.'.$group->percentage)),2);

                $evaluation_answers[] = ['area_id' => $group->id,
                    'area_name' => $group->name,
                    'area_percentage' => $group->percentage,
                    'number_of_questions' => $question_items,
                    'sub_total' => $sub_total,
                    'average' => $average,
                    'area_rating' => $area_rating,
                    'evaluation_data' => $evaluation_data];

                array_push($total_observation_rating, $area_rating);
            }

            $evaluation[] = (object)['student_id'=>$auth_user->id,
                'semester'=>$semester->value,
                'school_year'=>$school_year->value,
                'subject_code'=>$subject_code,
                'section_code'=>$section_code,
                'faculty_id'=> $sjc_id,
                'total_observation_rating'=> array_sum($total_observation_rating),
                'evaluation_data'=>$evaluation_answers,
                'comments' => $comments];

            $evaluation_json = json_encode($evaluation);

            $migration_record->evaluation = $evaluation_json;
            $migration_record->status = '1';
            $migration_record->save();

            return redirect(route('faculty.index'))->withSuccess('Your evaluation of the faculty is successfully saved.');


        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
