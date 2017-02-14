<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentHeads;
use App\Models\GlobalVariables;
use App\Models\RoleUser;
use App\User;

use Auth;

class DeanReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $heads = RoleUser::where('role_id', 4)
                ->paginate(50);

            return view('pages.reports.dean.index', compact('heads'));
        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function view($id){

        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $dean = User::find($id);

            $dean_reports = DepartmentHeads::where('dean_id', $id)
                ->where('semester', $semester->value)
                ->where('school_year', $school_year->value)
                ->get();

            $faculty_number = count($dean_reports);

            $done_evaluating_raw = DepartmentHeads::where('dean_id', $id)
                ->where('semester', $semester->value)
                ->where('school_year', $school_year->value)
                ->where('status', 1)
                ->get();

            $done_evaluating = count($done_evaluating_raw);

            $not_done_evaluating_raw = DepartmentHeads::where('dean_id', $id)
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
                    array_push($average_data, $v->over_all_average);
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

            return view('pages.reports.dean.view', compact('dean_reports','dean','faculty_number','done_evaluating', 'not_done_evaluating','average','comments_data'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function details($detail_id, $dean_id){
        $auth_user = Auth::user();

        $semester = GlobalVariables::where('name','semester')->first();
        $school_year = GlobalVariables::where('name','school_year')->first();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $dean = User::find($dean_id);

            if($detail_id == 1){
                $detail[] = [
                    'title' => 'List of Faculty Evaluating: '. $dean->last_name.', '. $dean->first_name
                ];

                $faculties_raw = DepartmentHeads::where('dean_id', $dean_id)
                    ->where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->get();

                $faculties = [];

                foreach($faculties_raw as $v){
                    $rating ='';

                    if($v->status==1){
                        $evaluation_data = json_decode($v->evaluation);

                        foreach($evaluation_data as $value){
                            $rating = $value->over_all_average;
                        }
                    }

                    $faculties[] = (object)[
                        'id' => $v->id,
                        'sjc_id' => $v->faculty->sjc_id,
                        'last_name' => $v->faculty->last_name,
                        'first_name' => $v->faculty->first_name,
                        'status' => $v->status,
                        'rating' => $rating
                    ];
                }


                return view('pages.reports.dean.details', compact('detail','faculties','dean'));

            }elseif($detail_id==2){
                $detail[] = [
                    'title' => 'List of Faculty Done Evaluating: '. $dean->last_name.', '. $dean->first_name
                ];

                $faculties_raw = DepartmentHeads::where('dean_id', $dean_id)
                    ->where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('status', 1)
                    ->get();

                $faculties = [];

                foreach($faculties_raw as $v){
                    $rating ='';

                    if($v->status==1){
                        $evaluation_data = json_decode($v->evaluation);

                        foreach($evaluation_data as $value){
                            $rating = $value->over_all_average;
                        }
                    }

                    $faculties[] = (object)[
                        'id' => $v->id,
                        'sjc_id' => $v->faculty->sjc_id,
                        'last_name' => $v->faculty->last_name,
                        'first_name' => $v->faculty->first_name,
                        'status' => $v->status,
                        'rating' => $rating
                    ];
                }


                return view('pages.reports.dean.details', compact('detail','faculties','dean'));

            }else{

                $detail[] = [
                    'title' => 'List of Faculty Not Done Evaluating: '. $dean->last_name.', '. $dean->first_name
                ];

                $faculties_raw = DepartmentHeads::where('dean_id', $dean_id)
                    ->where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('status', 0)
                    ->get();

                $faculties = [];

                foreach($faculties_raw as $v){
                    $rating ='';

                    if($v->status==1){
                        $evaluation_data = json_decode($v->evaluation);

                        foreach($evaluation_data as $value){
                            $rating = $value->over_all_average;
                        }
                    }

                    $faculties[] = (object)[
                        'id' => $v->id,
                        'sjc_id' => $v->faculty->sjc_id,
                        'last_name' => $v->faculty->last_name,
                        'first_name' => $v->faculty->first_name,
                        'status' => $v->status,
                        'rating' => $rating
                    ];
                }


                return view('pages.reports.dean.details', compact('detail','faculties','dean'));
            }

        }else{
            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(DepartmentHeads $id){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $id->delete();

            return redirect(route('deans_reports.details',['1',$id->dean_id]))->withSuccess('Faculty Removed.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }
}
