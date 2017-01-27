<?php

use Illuminate\Database\Seeder;

class MigrationOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('migrate_options')->insert([
            'id' => '1',
            'name' => 'STUDENT RECORDS COLLEGE LEVEL',
            'status' => '0'
        ]);

        DB::table('migrate_options')->insert([
            'id' => '2',
            'name' => 'STUDENT RECORDS GRADUATE SCHOOL',
            'status' => '0'
        ]);

        DB::table('migrate_options')->insert([
            'id' => '3',
            'name' => 'STUDENT RECORDS SENIOR HIGH SCHOOL ',
            'status' => '0'
        ]);

        DB::table('migrate_options')->insert([
            'id' => '4',
            'name' => 'MIGRATE USERS STUDENTS COLLEGE',
            'status' => '0'
        ]);

        DB::table('migrate_options')->insert([
            'id' => '5',
            'name' => 'MIGRATE USERS STUDENTS GRADUATE',
            'status' => '0'
        ]);

        DB::table('migrate_options')->insert([
            'id' => '6',
            'name' => 'MIGRATE USERS STUDENTS SHS',
            'status' => '0'
        ]);

        DB::table('migrate_options')->insert([
            'id' => '7',
            'name' => 'MIGRATE USERS EMPLOYEES COLLEGE',
            'status' => '0'
        ]);

        DB::table('migrate_options')->insert([
            'id' => '8',
            'name' => 'MIGRATE USERS EMPLOYEES GRADUATE',
            'status' => '0'
        ]);

        DB::table('migrate_options')->insert([
            'id' => '9',
            'name' => 'MIGRATE USERS EMPLOYEES SHS',
            'status' => '0'
        ]);
    }
}
