<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentHeads;
use App\Models\GlobalVariables;
use App\Models\RoleUser;
use App\User;
use App\Models\Groups;

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

            $user_ids = RoleUser::where('role_id', 4)
                ->pluck('user_id');

            $heads = User::whereIn('id', $user_ids)
                ->paginate(50);

            return view('pages.reports.dean.index', compact('heads'));
        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){
            $user_ids = RoleUser::where('role_id', 4)
                ->pluck('user_id');

            $heads = User::whereIn('id', $user_ids)
                ->where('first_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('sjc_id', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_of', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('school_code', 'LIKE', '%'.$request->get('search').'%')
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

    public function rating($rating_id, $dean_id){

        $auth_user = Auth::user();

        if($auth_user->hasRole(['system-administrator','reports'])){

            $dean = User::find($dean_id);

            if($rating_id == 1){

                $detail[] = [
                    'title' => 'Average Rating Details '. $dean->last_name.', '. $dean->first_name
                ];

                $average_details = [];
                $average_values = [];
                $raw_data  = DepartmentHeads::where('dean_id',$dean_id)
                    ->get();

                $headers = Groups::where('for_id', 2)
                    ->where('active',1)
                    ->orderBy('priority', 'asc')
                    ->get();

                foreach ($headers as $key=>$header){
                    $scores[$key][] = [];
                }

                foreach ($raw_data as $value){

                    $area_data = [];

                    $evaluation_data = json_decode($value->evaluation);

                    if(!empty($evaluation_data)){
                        foreach ($evaluation_data as $ev){
                            $evd = [];
                            foreach ($ev->evaluation_data as $ed){
                                $evd[]=(object)[
                                    'area_average' => $ed->average,
                                    'area_name' => $ed->area_name
                                ];

                                foreach ($headers as $key=>$header){
                                    if($header->id == $ed->area_id){
                                        array_push($scores[$key], $ed->average);
                                    }
                                }
                            }

                            $area_data[] = (object)[
                                'average_rating' => $ev->over_all_average,
                                'evaluation_data' => $evd
                            ];

                            array_push($average_values,$ev->over_all_average);
                        }
                    }


                    $average_details[]=(object)[
                        'faculty_name' => $value->faculty->last_name.', '.$value->faculty->first_name,
                        'area_ratings' => $area_data
                    ];
                }

                foreach ($headers as $key=>$header){

                    $header_sum = count($scores[$key])-1;
                    $header_total = array_sum($scores[$key]);
                    $header_average = !empty($header_total)? round($header_total/$header_sum,2):'';

                    $headers_scores[$key] = [
                        'id' => $header->id,
                        'header_sum' => $header_sum,
                        'header_total' => $header_total,
                        'header_average' => $header_average
                    ];
                }

                $total_count = count($average_values);
                $total_sum = array_sum($average_values);

                $average = !empty($total_count)?round($total_sum/$total_count,2):'0';

                return view('pages.reports.dean.rating', compact('detail','dean','average_details','average','headers', 'headers_scores','scores'));
            }else{

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
