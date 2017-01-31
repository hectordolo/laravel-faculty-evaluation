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
                        $faculties[]=(object)['sjc_id'=> $faculty->sjc_id,
                            'employee_name'=>$faculty->last_name.', '.$faculty->first_name,
                            'school_of'=>$faculty->school_of,
                            'subject_code'=>$value->subject_code,
                            'section_code'=>$value->section_code,
                            'faculty'=>'Yes',
                            'status'=>$value->status
                        ];
                    }else{
                        $faculties[]=(object)['sjc_id'=> $value->employee_code,
                            'employee_name'=>$value->employee_name,
                            'school_of'=>'Empty',
                            'subject_code'=>$value->subject_code,
                            'section_code'=>$value->section_code,
                            'faculty'=>'Yes',
                            'status'=>$value->status];
                    }
                }else{
                    $faculties[]=(object)['sjc_id'=> '',
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

    public function evaluate($sjc_id,$subject_code,$section_code)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole('student')){

            $faculty = User::where('sjc_id', $sjc_id)
                ->first();

            $carbon = Carbon::now()->subHour(8);
            $time = $carbon->toDayDateTimeString();

            $semester = GlobalVariables::where('name','semester')->first();
            $school_year = GlobalVariables::where('name','school_year')->first();

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

            return view('pages.student.evaluate', compact('faculty','time','subject_code','section_code','semester','school_year','for_faculty','questions'));

        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function store(Request $request,$subject_code,$section_code){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole('student')){

            $sjc_id = $request->input('sjc_id');

            $trait_id = $request->input('trait_id');
            $area_id = $request->input('area_id');
            $trait_scores = $request->input('trait_score');

            $count = count($trait_id);

            foreach ($trait_id as $key=>$v){
                $trait_score[] = (object)['area_id'=>$area_id[$key],
                    'trait_id'=>$v,
                    'trait_score'=>$trait_scores[$key]];
            }

            $data[] = (object)['user_id'=>$auth_user->id,
                'semester'=>$semester->value,
                'school_year'=>$school_year->value,
                'subject_code'=>$subject_code,
                'section_code'=>$section_code,
                'employee_id'=> $sjc_id,
                'trait_score'=>$trait_score];

            $count = count($area_id);

            $migration_record = MigrateRecords::where('semester',$semester->value)
                ->where('school_year',$school_year->value)
                ->where('sjc_id',$auth_user->sjc_id)
                ->where('subject_code',$subject_code)
                ->where('section_code',$section_code)
                ->first();

            $json = json_encode($data);

            $migration_record->evaluation = $json;
            $migration_record->save();

            return view('pages.test',compact('data','count'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
