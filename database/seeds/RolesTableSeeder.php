<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => '1',
            'name' => 'system-administrator',
            'display_name' => 'System Administrator',
            'description' => 'This user role is the one managging the system.'
        ]);

        DB::table('roles')->insert([
            'id' => '2',
            'name' => 'user-manager',
            'display_name' => 'Users Manager',
            'description' => 'This user role can manage existing users.'
        ]);

        DB::table('roles')->insert([
            'id' => '3',
            'name' => 'vpaa',
            'display_name' => 'Vice President for Academic Affairs',
            'description' => 'This user role can access all the reports about a faculty and the deans.'
        ]);

        DB::table('roles')->insert([
            'id' => '4',
            'name' => 'dean',
            'display_name' => 'Dean',
            'description' => 'This user role is for the deans of SJC.'
        ]);

        DB::table('roles')->insert([
            'id' => '5',
            'name' => 'faculty',
            'display_name' => 'Faculty',
            'description' => 'This user role is for the faculties of SJC.'
        ]);


        DB::table('roles')->insert([
            'id' => '6',
            'name' => 'student',
            'display_name' => 'Student',
            'description' => 'This user role is for the students of sjc who will be evaluating their instructors and professors.'
        ]);

        DB::table('roles')->insert([
            'id' => '7',
            'name' => 'reports',
            'display_name' => 'View Reports',
            'description' => 'The user can view Result of Evaluation.'
        ]);
    }
}
