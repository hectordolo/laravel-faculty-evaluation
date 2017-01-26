<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MigrateRecords;
use App\Models\GlobalVariables;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class MigrateRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $records = MigrateRecords::paginate(100);

            return view('pages.migrate_records.index', compact('records'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function migrate(){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $semester = GlobalVariables::where('name','semester')->first();

            $school_year = GlobalVariables::where('name','school_year')->first();

            $delete = MigrateRecords::where('semester', $semester->value)
                ->where('school_year',$school_year->value)
                ->delete();


            $records = [];

            $raw_data = DB::connection('college')
                ->select("SELECT
                                registrations.studentcode as student_code,
                                registrations.sectioncode as section_code,
                                registrations.subjectcode as subject_code,
                                sectionssubjects.employeecode as employee_code,
                                '0' as `status`,
                                registrations.semester,
                                registrations.schoolyear
                            FROM
                                registrations
                            INNER JOIN
                                sectionssubjects
                            ON
                                sectionssubjects.sectioncode = registrations.sectioncode
                            AND
                                sectionssubjects.subjectcode = registrations.subjectcode
                            WHERE
                                registrations.semester = '$semester->value'
                            AND
                                registrations.schoolyear = '$school_year->value'");


            foreach ($raw_data as $v){
                MigrateRecords::create([
                    'student_code' => $v->student_code,
                    'section_code' => $v->section_code,
                    'subject_code' => $v->subject_code,
                    'employee_code' => $v->employee_code,
                    'status' => $v->status,
                    'semester' => $semester->value,
                    'school_year' => $school_year->value
                ]);
            }


            return redirect(route('migrate_records.index'))->withSuccess('The record is successfully migrated.');

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function destroy(MigrateRecords $record)
    {
        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){
            $record = $record;
            $record->delete();

            return redirect(route('migrate_records.index'))->withSuccess('The record is successfully deleted.');

        }else{
            return redirect()->route('four.zero.five');
        }

    }

    public function search(Request $request){

        $auth_user = Auth::user();

        if($auth_user->ability('system-administrator, users-manager','users-read')){
            $employees = User::where('last_name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('first_name', 'LIKE', '%'.$request->get('search').'%')
                ->paginate(50);

            return view('pages.users.employees.index', compact('employees'));
        }else{
            return redirect()->route('four.zero.five');
        }
    }
}
