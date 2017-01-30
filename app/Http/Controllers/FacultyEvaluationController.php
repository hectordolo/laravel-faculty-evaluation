<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MigrateRecords;
use App\Models\GlobalVariables;
use App\User;
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
                            'status'=>'Yes'
                        ];
                    }else{
                        $faculties[]=(object)['sjc_id'=> $value->employee_code,
                            'employee_name'=>$value->employee_name,
                            'school_of'=>'Empty',
                            'subject_code'=>$value->subject_code,
                            'section_code'=>$value->section_code,
                            'status'=>'Yes'];
                    }
                }else{
                    $faculties[]=(object)['sjc_id'=> '',
                        'employee_name'=>'',
                        'school_of'=>'',
                        'subject_code'=>$value->subject_code,
                        'section_code'=>$value->section_code,
                        'status'=>'No'];
                }
            }

            return view('pages.student.index', compact('faculties','auth_user'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function evaluate($sjc_id)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole('student')){

            //$deans = [];

            return view('pages.faculty.evaluate');

        }else{

            return redirect()->route('four.zero.five');
        }

    }
}
