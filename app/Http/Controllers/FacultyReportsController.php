<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\MigrateRecords;
use App\Models\GlobalVariables;
use App\Models\RoleUser;

use Auth;

class FacultyReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $user_ids = RoleUser::where('role_id', 5)
                ->pluck('user_id');

            $faculties = User::whereIn('id', $user_ids)
                ->paginate(50);

            return view('pages.reports.faculty.index', compact('faculties'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function view($id){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $faculty = User::find($id);

            $faculty_reports = MigrateRecords::where('employee_code', $faculty->sjc_id)
                ->where('semester', $semester->value)
                ->where('school_year', $school_year->value)
                ->get();

            $faculty_number = count($faculty_reports);

            $done_evaluating_raw = MigrateRecords::where('employee_code', $faculty->sjc_id)
                ->where('semester', $semester->value)
                ->where('school_year', $school_year->value)
                ->where('status', 1)
                ->get();

            $done_evaluating = count($done_evaluating_raw);

            $not_done_evaluating_raw = MigrateRecords::where('employee_code', $faculty->sjc_id)
                ->where('semester', $semester->value)
                ->where('school_year', $school_year->value)
                ->where('status', 0)
                ->get();

            $not_done_evaluating = count($not_done_evaluating_raw);

            $average = [];
            $average_data = [];
            $comments_data = [];

            foreach ($done_evaluating_raw as $value){

                $evaluation_data = json_decode($value->evaluation);

                foreach ($evaluation_data as $v){
                    array_push($average_data, $v->total_observation_rating);
                    if(!empty($v->comments)){
                        array_push($comments_data, $v->comments);
                    }
                }
            }

            $average_total = array_sum($average_data);
            $average_count = count($average_data);
            $average_value = 'N/A';

            if(!empty($average_count)){
                $average_value = round(($average_total/$average_count),2);
            }

            $average[] = [
                'average_value' => $average_value,
                'average_count' => $average_count,
                'average_total' => $average_total,
                'average_highest' => !empty($average_data)?max($average_data):'N/A',
                'average_lowest' => !empty($average_data)?min($average_data):'N/A'
            ];

            $number_sections = $faculty_reports->groupBy('section_code')->count();

            $number_subjects = $faculty_reports->groupBy('subject_code')->count();

            return view('pages.reports.faculty.view', compact('faculty','faculty_number','done_evaluating','not_done_evaluating','average','comments_data','number_sections','number_subjects'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function details($detail_id, $faculty_id){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $faculty = User::find($faculty_id);

            if($detail_id == 1){

                $detail[] = [
                    'title' => 'List of Students Evaluating '. $faculty->last_name.', '. $faculty->first_name
                ];

                $students_raw = MigrateRecords::where('employee_code', $faculty->sjc_id)
                    ->where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->get();

                $students = [];

                foreach($students_raw as $v){
                    $rating ='';

                    if($v->status==1){
                        $evaluation_data = json_decode($v->evaluation);

                        foreach($evaluation_data as $value){
                            $rating = $value->total_observation_rating;
                        }
                    }

                    $students[] = (object)[
                        'id' => $v->id,
                        'sjc_id' => $v->student->sjc_id,
                        'last_name' => $v->student->last_name,
                        'first_name' => $v->student->first_name,
                        'status' => $v->status,
                        'subject_code' => $v->subject_code,
                        'section_code' => $v->section_code,
                        'rating' => $rating
                    ];
                }


                return view('pages.reports.faculty.details', compact('detail','students','faculty'));

            }elseif($detail_id==2){

                $detail[] = [
                    'title' => 'List of Students not Done evaluating '. $faculty->last_name.', '. $faculty->first_name
                ];

                $students_raw = MigrateRecords::where('employee_code', $faculty->sjc_id)
                    ->where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('status', 1)
                    ->get();

                $students = [];

                foreach($students_raw as $v){
                    $rating ='';

                    if($v->status==1){
                        $evaluation_data = json_decode($v->evaluation);

                        foreach($evaluation_data as $value){
                            $rating = $value->total_observation_rating;
                        }
                    }

                    $students[] = (object)[
                        'id' => $v->id,
                        'sjc_id' => $v->student->sjc_id,
                        'last_name' => $v->student->last_name,
                        'first_name' => $v->student->first_name,
                        'subject_code' => $v->subject_code,
                        'section_code' => $v->section_code,
                        'status' => $v->status,
                        'rating' => $rating
                    ];
                }


                return view('pages.reports.faculty.details', compact('detail','students','faculty'));

            }else{

                $detail[] = [
                    'title' => 'List of Students Done Evaluating  '. $faculty->last_name.', '. $faculty->first_name
                ];

                $students_raw = MigrateRecords::where('employee_code', $faculty->sjc_id)
                    ->where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('status', 0)
                    ->get();

                $students = [];

                foreach($students_raw as $v){
                    $rating ='';

                    if($v->status==1){
                        $evaluation_data = json_decode($v->evaluation);

                        foreach($evaluation_data as $value){
                            $rating = $value->total_observation_rating;
                        }
                    }

                    $students[] = (object)[
                        'id' => $v->id,
                        'sjc_id' => $v->student->sjc_id,
                        'last_name' => $v->student->last_name,
                        'first_name' => $v->student->first_name,
                        'subject_code' => $v->subject_code,
                        'section_code' => $v->section_code,
                        'status' => $v->status,
                        'rating' => $rating
                    ];
                }


                return view('pages.reports.faculty.details', compact('detail','students','faculty'));
            }

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function rating($rating_id, $faculty_id){
        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $faculty = User::find($faculty_id);

            if($rating_id == 1){

                $detail[] = [
                    'title' => 'Average Rating Details '. $faculty->last_name.', '. $faculty->first_name
                ];

                $average_details = [];

                $raw_data  = MigrateRecords::select('section_code','subject_code')
                    ->where('employee_code', $faculty->sjc_id)
                    ->groupBy('section_code')
                    ->groupBy('subject_code')
                    ->get();

                $average_raw = [];

                foreach ($raw_data as $value){

                    $total = MigrateRecords::where('employee_code', $faculty->sjc_id)
                        ->where('section_code',$value->section_code)
                        ->where('subject_code',$value->subject_code)
                        ->get();

                    $total_students_raw = [];
                    $total_rating_raw =[];
                    $done_evaluation_raw = [];

                    foreach ($total as $value){

                        $evaluation_data = json_decode($value->evaluation);

                        if(!empty($evaluation_data)){
                            foreach($evaluation_data as $ev){
                                array_push($done_evaluation_raw, $ev->student_id);
                                array_push($total_rating_raw, $ev->total_observation_rating);
                                array_push($average_raw, $ev->total_observation_rating);
                            }
                        }else{
                            array_push($total_students_raw, $value->id);
                        }
                    }

                    $count = count($total_students_raw);
                    $done_evaluation = count($done_evaluation_raw);
                    $total_rating = array_sum($total_rating_raw);

                    $average_details[]=(object)[
                        'section_code' => $value->section_code,
                        'subject_code' => $value->subject_code,
                        'total_students' => $count,
                        'done_evaluation' => !empty($done_evaluation)?$done_evaluation:'0',
                        'total_rating' => !empty($total_rating)?$total_rating:'---',
                        'average_rating' => !empty($total_rating)?round($total_rating/$done_evaluation,2):'---'
                    ];



                }

                $total_count = count($average_raw);
                $total_sum = array_sum($average_raw);

                $average = !empty($total_count)?round($total_sum/$total_count,2):'0';

                return view('pages.reports.faculty.rating', compact('detail','faculty','average_details','average'));
            }else{

            }

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $user_ids = RoleUser::where('role_id', 5)
                ->pluck('user_id');

            $faculties = User::where('first_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('sjc_id', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_of', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_code', 'LIKE', '%'.$request->get('search').'%')
                ->whereIn('id', $user_ids)
                ->paginate(50);

            return view('pages.reports.faculty.index', compact('faculties','user_ids'));

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(MigrateRecords $id){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $id->delete();

            return redirect(route('faculty_reports.details',['1',$id->sjc_id]))->withSuccess('Student Removed.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }
}
