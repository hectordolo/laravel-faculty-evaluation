<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

use App\Models\GlobalVariables;
use App\Models\MigrationOptions;
use App\Models\MigrateRecords;
use App\Models\RoleUser;
use App\User;

use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class MigrateSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $records = MigrationOptions::get();

            return view('pages.migrate_records.index', compact('records'));

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function migrate($id){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $semester = GlobalVariables::where('name','semester')->first();
            $school_year = GlobalVariables::where('name','school_year')->first();

            if($id == 1) {

                $raw_data = DB::connection('college')
                    ->select("SELECT
                                registrations.studentcode as student_code,
                                registrations.sectioncode as section_code,
                                registrations.subjectcode as subject_code,
                                sectionssubjects.employeecode as employee_code,
                                (SELECT CONCAT(lname,', ',fname) 
                                      FROM employees 
                                      WHERE employeecode = sectionssubjects.employeecode) as employee_name,
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

                $record = MigrationOptions::find(1);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){
                        MigrateRecords::create([
                                'student_code' => $v->student_code,
                                'section_code' => $v->section_code,
                                'subject_code' => $v->subject_code,
                                'employee_code' => $v->employee_code,
                                'employee_name' => $v->employee_name,
                                'status' => $v->status,
                                'semester' => $semester->value,
                                'school_year' => $school_year->value,
                                'school_code' => 'COLLEGE'
                            ]);

                    }


                    $record->status = '1';
                    $record->save();
                }


                return redirect(route('migrate_options.index'))->withSuccess('The record of:' . $record->name . ' are successfully migrated.');
            }elseif ($id == 2){

                $raw_data = DB::connection('graduate')
                    ->select("SELECT
                                registrations.studentcode as student_code,
                                registrations.sectioncode as section_code,
                                registrations.subjectcode as subject_code,
                                sectionssubjects.employeecode as employee_code,
                                (SELECT CONCAT(lname,', ',fname) 
                                      FROM employees 
                                      WHERE employeecode = sectionssubjects.employeecode) as employee_name,
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


                $record = MigrationOptions::find(2);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){
                        MigrateRecords::create([
                            'student_code' => $v->student_code,
                            'section_code' => $v->section_code,
                            'subject_code' => $v->subject_code,
                            'employee_code' => $v->employee_code,
                            'employee_name' => $v->employee_name,
                            'status' => $v->status,
                            'semester' => $semester->value,
                            'school_year' => $school_year->value,
                            'school_code' => 'GRADUATE'
                        ]);
                    }


                    $record->status = '1';
                    $record->save();
                }

                return redirect(route('migrate_options.index'))->withSuccess('The record of:'.$record->name.' are successfully migrated.');
            }elseif ($id == 3)  {

                $raw_data = DB::connection('shs')
                    ->select("SELECT
                                registrations.studentcode as student_code,
                                registrations.sectioncode as section_code,
                                registrations.subjectcode as subject_code,
                                sectionssubjects.employeecode as employee_code,
                                (SELECT CONCAT(lname,', ',fname) 
                                      FROM employees 
                                      WHERE employeecode = sectionssubjects.employeecode) as employee_name,
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


                $record = MigrationOptions::find(3);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){
                        MigrateRecords::create([
                            'student_code' => $v->student_code,
                            'section_code' => $v->section_code,
                            'subject_code' => $v->subject_code,
                            'employee_code' => $v->employee_code,
                            'employee_name' => $v->employee_name,
                            'status' => $v->status,
                            'semester' => $semester->value,
                            'school_year' => $school_year->value,
                            'school_code' => 'SHS'
                        ]);
                    }


                    $record->status = '1';
                    $record->save();
                }

                return redirect(route('migrate_options.index'))->withSuccess('The record of:'.$record->name.' are successfully migrated.');

            }elseif ($id == 4) {

                $raw_data = DB::connection('college')
                    ->select("SELECT 
                                DISTINCT
                                    registrations.studentcode as sjc_id,
                                    students.lname as last_name,
                                    students.fname as first_name,
                                    students.degreecode as course,
                                    students.schoolcode as school_of 
                                FROM
                                    registrations
                                
                                INNER JOIN
                                    students
                                ON
                                    registrations.studentcode = students.studentcode
                                    
                                WHERE
                                    registrations.semester = '$semester->value'
                                AND
                                    registrations.schoolyear = '$school_year->value'");


                $record = MigrationOptions::find(4);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){

                        $available = User::where('sjc_id', $v->sjc_id)
                            ->first();

                        if(empty($available)){

                            $user = User::create([
                                'sjc_id' => $v->sjc_id,
                                'last_name' => $v->last_name,
                                'first_name' => $v->first_name,
                                'username' => $v->sjc_id,
                                'password' => bcrypt($v->sjc_id),
                                'school_code' => 'COLLEGE',
                                'type' => 'STUDENT',
                                'course' => $v->course,
                                'school_of' => $v->school_of,
                                'semester' => $semester->value,
                                'school_year' => $school_year->value
                            ]);

                            $user_role = RoleUser::insert([
                                'user_id' => $user->id,
                                'role_id' => '6'
                            ]);

                        }
                    }


                    $record->status = '1';
                    $record->save();
                }

                return redirect(route('migrate_options.index'))->withSuccess('The record of:' . $record->name . ' are successfully migrated.');

            }elseif ($id == 5){

                $raw_data = DB::connection('graduate')
                    ->select("SELECT 
                                DISTINCT
                                    registrations.studentcode as sjc_id,
                                    students.lname as last_name,
                                    students.fname as first_name,
                                    students.degreecode as course,
                                    students.schoolcode as school_of 
                                FROM
                                    registrations
                                
                                INNER JOIN
                                    students
                                ON
                                    registrations.studentcode = students.studentcode
                                    
                                WHERE
                                    registrations.semester = '$semester->value'
                                AND
                                    registrations.schoolyear = '$school_year->value'");


                $record = MigrationOptions::find(5);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){

                        $available = User::where('sjc_id', $v->sjc_id)
                            ->first();

                        if(empty($available)){

                            $user = User::create([
                                'sjc_id' => $v->sjc_id,
                                'last_name' => $v->last_name,
                                'first_name' => $v->first_name,
                                'username' => $v->sjc_id,
                                'password' => bcrypt($v->sjc_id),
                                'school_code' => 'GRADUATE',
                                'type' => 'STUDENT',
                                'course' => $v->course,
                                'school_of' => $v->school_of,
                                'semester' => $semester->value,
                                'school_year' => $school_year->value
                            ]);

                            $user_role = RoleUser::insert([
                                'user_id' => $user->id,
                                'role_id' => '6'
                            ]);
                        }
                    }


                    $record->status = '1';
                    $record->save();
                }

                return redirect(route('migrate_options.index'))->withSuccess('The record of:' . $record->name . ' are successfully migrated.');

            }elseif ($id == 6){

                $raw_data = DB::connection('shs')
                    ->select("SELECT 
                                DISTINCT
                                    registrations.studentcode as sjc_id,
                                    students.lname as last_name,
                                    students.fname as first_name,
                                    students.degreecode as course,
                                    students.schoolcode as school_of 
                                FROM
                                    registrations
                                
                                INNER JOIN
                                    students
                                ON
                                    registrations.studentcode = students.studentcode
                                    
                                WHERE
                                    registrations.semester = '$semester->value'
                                AND
                                    registrations.schoolyear = '$school_year->value'");


                $record = MigrationOptions::find(6);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){

                        $available = User::where('sjc_id', $v->sjc_id)
                            ->first();

                        if(empty($available)) {

                            $user = User::create([
                                'sjc_id' => $v->sjc_id,
                                'last_name' => $v->last_name,
                                'first_name' => $v->first_name,
                                'username' => $v->sjc_id,
                                'password' => bcrypt($v->sjc_id),
                                'school_code' => 'SHS',
                                'type' => 'STUDENT',
                                'course' => $v->course,
                                'school_of' => $v->school_of,
                                'semester' => $semester->value,
                                'school_year' => $school_year->value
                            ]);

                            $user_role = RoleUser::insert([
                                'user_id' => $user->id,
                                'role_id' => '6'
                            ]);
                        }

                    }


                    $record->status = '1';
                    $record->save();
                }

                return redirect(route('migrate_options.index'))->withSuccess('The record of:' . $record->name . ' are successfully migrated.');

            }elseif ($id == 7){



                $raw_data = DB::connection('college')
                    ->select("SELECT
                                    DISTINCT 
                                    sectionssubjects.employeecode as sjc_id,
                                    employees.lname as last_name,
                                    employees.fname as first_name,
                                    employees.schoolcode as school_of,
                                    employees.jobtitlecode as job_title
                                    
                                FROM
                                    sectionssubjects
                                INNER JOIN
                                    employees
                                ON
                                    sectionssubjects.employeecode = employees.employeecode
                                
                                WHERE
                                    employees.lname != 'TBA'
                                AND
                                    sectionssubjects.semester = '$semester->value'
                                AND
                                    sectionssubjects.schoolyear = '$school_year->value'");


                $record = MigrationOptions::find(7);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){

                        $available = User::where('sjc_id', $v->sjc_id)
                            ->first();

                        if(empty($available)) {
                            $user = User::create([
                                'sjc_id' => $v->sjc_id,
                                'last_name' => $v->last_name,
                                'first_name' => $v->first_name,
                                'username' => $v->sjc_id,
                                'password' => bcrypt($v->sjc_id),
                                'school_code' => 'COLLEGE',
                                'type' => 'EMPLOYEE',
                                'course' => '',
                                'school_of' => $v->school_of,
                                'semester' => $semester->value,
                                'school_year' => $school_year->value
                            ]);

                            if($v->job_title == 'DEAN'){
                                $role = RoleUser::insert([
                                    'user_id' => $user->id,
                                    'role_id' => '4'
                                ]);
                            }

                            $user_role = RoleUser::insert([
                                'user_id' => $user->id,
                                'role_id' => '5'
                            ]);
                        }

                    }


                    $record->status = '1';
                    $record->save();
                }

                return redirect(route('migrate_options.index'))->withSuccess('The record of:' . $record->name . ' are successfully migrated.');

            }elseif ($id == 8){

                $raw_data = DB::connection('graduate')
                    ->select("SELECT
                                    DISTINCT 
                                    sectionssubjects.employeecode as sjc_id,
                                    employees.lname as last_name,
                                    employees.fname as first_name,
                                    employees.schoolcode as school_of,
                                    employees.jobtitlecode as job_title
                                    
                                FROM
                                    sectionssubjects
                                INNER JOIN
                                    employees
                                ON
                                    sectionssubjects.employeecode = employees.employeecode
                                
                                WHERE
                                    employees.lname != 'TBA'
                                AND
                                    sectionssubjects.semester = '$semester->value'
                                AND
                                    sectionssubjects.schoolyear = '$school_year->value'");


                $record = MigrationOptions::find(8);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){

                        $available = User::where('sjc_id', $v->sjc_id)
                            ->first();

                        if(empty($available)) {
                            $user = User::create([
                                'sjc_id' => $v->sjc_id,
                                'last_name' => $v->last_name,
                                'first_name' => $v->first_name,
                                'username' => $v->sjc_id,
                                'password' => bcrypt($v->sjc_id),
                                'school_code' => 'GRADUATE',
                                'type' => 'EMPLOYEE',
                                'course' => '',
                                'school_of' => $v->school_of,
                                'semester' => $semester->value,
                                'school_year' => $school_year->value
                            ]);

                            if($v->job_title == 'DEAN'){
                                $user_role = RoleUser::insert([
                                    'user_id' => $user->id,
                                    'role_id' => '4'
                                ]);
                            }

                            $user_role = RoleUser::insert([
                                'user_id' => $user->id,
                                'role_id' => '5'
                            ]);
                        }

                    }


                    $record->status = '1';
                    $record->save();
                }

                return redirect(route('migrate_options.index'))->withSuccess('The record of:' . $record->name . ' are successfully migrated.');

            }else{
                $raw_data = DB::connection('shs')
                    ->select("SELECT
                                    DISTINCT 
                                    sectionssubjects.employeecode as sjc_id,
                                    employees.lname as last_name,
                                    employees.fname as first_name,
                                    employees.schoolcode as school_of,
                                    employees.jobtitlecode as job_title
                                    
                                FROM
                                    sectionssubjects
                                INNER JOIN
                                    employees
                                ON
                                    sectionssubjects.employeecode = employees.employeecode
                                
                                WHERE
                                    employees.lname != 'TBA'
                                AND
                                    sectionssubjects.semester = '$semester->value'
                                AND
                                    sectionssubjects.schoolyear = '$school_year->value'");


                $record = MigrationOptions::find(9);

                if(!empty($raw_data)){
                    foreach ($raw_data as $v){

                        $available = User::where('sjc_id', $v->sjc_id)
                            ->first();

                        if(empty($available)) {
                            $user = User::create([
                                'sjc_id' => $v->sjc_id,
                                'last_name' => $v->last_name,
                                'first_name' => $v->first_name,
                                'username' => $v->sjc_id,
                                'password' => bcrypt($v->sjc_id),
                                'school_code' => 'SHS',
                                'type' => 'EMPLOYEE',
                                'course' => '',
                                'school_of' => $v->school_of,
                                'semester' => $semester->value,
                                'school_year' => $school_year->value
                            ]);

                            if($v->job_title == 'DEAN'){
                                $user_role = RoleUser::insert([
                                    'user_id' => $user->id,
                                    'role_id' => '4'
                                ]);
                            }

                            $user_role = RoleUser::insert([
                                'user_id' => $user->id,
                                'role_id' => '5'
                            ]);
                        }

                    }

                    $record->status = '1';
                    $record->save();
                }

                return redirect(route('migrate_options.index'))->withSuccess('The record of:' . $record->name . ' are successfully migrated.');
            }




            return redirect(route('migrate_options.index'))->withSuccess('The record are successfully migrated.');

        }else{

            return redirect()->route('four.zero.five');
        }
    }

    public function delete($id){

        $auth_user = Auth::user();

        if($auth_user->hasRole('system-administrator')){

            $semester = GlobalVariables::where('name','semester')->first();
            $school_year = GlobalVariables::where('name','school_year')->first();

            if($id == 1){

                $records = MigrateRecords::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'COLLEGE')
                    ->delete();

                $record = MigrationOptions::find(1);
                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');

            }elseif ($id == 2){

                $records = MigrateRecords::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'GRADUATE')
                    ->delete();

                $record = MigrationOptions::find(2);
                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');

            }elseif ($id == 3){

                $records = MigrateRecords::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'SHS')
                    ->delete();

                $record = MigrationOptions::find(3);
                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');

            }elseif ($id == 4){
                $record = MigrationOptions::find(4);

                $users = User::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'COLLEGE')
                    ->get();

                if(!empty($users)){
                    foreach ($users as $v){
                        $user = User::destroy($v->id);
                        $role_delete = RoleUser::where('user_id', $v->id)->delete();
                    }
                }

                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');

            }elseif ($id == 5){
                $record = MigrationOptions::find(5);

                $users = User::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'GRADUATE')
                    ->get();

                if(!empty($users)){
                    foreach ($users as $v){
                        $user = User::destroy($v->id);
                        $role_delete = RoleUser::where('user_id', $v->id)->delete();
                    }
                }

                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');
            }elseif ($id == 6){
                $record = MigrationOptions::find(6);

                $users = User::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'SHS')
                    ->get();

                if(!empty($users)){
                    foreach ($users as $v){
                        $user = User::destroy($v->id);
                        $role_delete = RoleUser::where('user_id', $v->id)->delete();
                    }
                }

                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');

            }elseif ($id == 7){

                $record = MigrationOptions::find(7);

                $users = User::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'COLLEGE')
                    ->where('type','EMPLOYEE')
                    ->get();

                if(!empty($users)){
                    foreach ($users as $v){
                        $user = User::destroy($v->id);
                        $role_delete = RoleUser::where('user_id', $v->id)->delete();
                    }
                }

                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');

            }elseif ($id == 8){
                $record = MigrationOptions::find(8);

                $users = User::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'GRADUATE')
                    ->where('type','EMPLOYEE')
                    ->get();

                if(!empty($users)){
                    foreach ($users as $v){
                        $user = User::destroy($v->id);
                        $role_delete = RoleUser::where('user_id', $v->id)->delete();
                    }
                }

                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');

            }else{
                $record = MigrationOptions::find(9);

                $users = User::where('semester', $semester->value)
                    ->where('school_year', $school_year->value)
                    ->where('school_code', 'SHS')
                    ->where('type','EMPLOYEE')
                    ->get();

                if(!empty($users)){
                    foreach ($users as $v){
                        $user = User::destroy($v->id);
                        $role_delete = RoleUser::where('user_id', $v->id)->delete();
                    }
                }

                $record->status = '0';
                $record->save();

                return redirect(route('migrate_options.index'))->withSuccess('The records under:'.$record->name.' are deleted.');
            }

        }else{

            return redirect()->route('four.zero.five');
        }
    }
}

