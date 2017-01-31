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

    public function store(Request $request){

        $sjc_id = $request->input('sjc_id');
        $employee_name = $request->input('employee_name');
        $data = [];

        $data[]=(object)['sjc_id'=>$sjc_id,
            'employee_name'=>$employee_name];


        return view('pages.test',compact('data'));
    }
}
