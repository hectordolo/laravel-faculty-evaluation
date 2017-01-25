<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'id' => '1',
            'name' => 'PERSONALITY',
            'percentage' => '20',
            'priority' => '1',
            'for_id' => '1',
            'active' => '1'
        ]);

        DB::table('groups')->insert([
            'id' => '2',
            'name' => 'MASTERY OF SUBJECT MATTER',
            'percentage' => '30',
            'priority' => '2',
            'for_id' => '1',
            'active' => '1'
        ]);

        DB::table('groups')->insert([
            'id' => '3',
            'name' => 'METHODOLOGY',
            'percentage' => '30',
            'priority' => '3',
            'for_id' => '1',
            'active' => '1'
        ]);

        DB::table('groups')->insert([
            'id' => '4',
            'name' => 'CLASSROOM MANAGEMENT',
            'percentage' => '20',
            'priority' => '4',
            'for_id' => '1',
            'active' => '1'
        ]);

        DB::table('groups')->insert([
            'id' => '5',
            'name' => 'ADMINISTRATION',
            'percentage' => '30',
            'priority' => '1',
            'for_id' => '2',
            'active' => '1'
        ]);

        DB::table('groups')->insert([
            'id' => '6',
            'name' => 'FACULTY DEVELOPMENT',
            'percentage' => '35',
            'priority' => '2',
            'for_id' => '2',
            'active' => '1'
        ]);

        DB::table('groups')->insert([
            'id' => '7',
            'name' => 'STUDENT DEVELOPMENT',
            'percentage' => '35',
            'priority' => '3',
            'for_id' => '2',
            'active' => '1'
        ]);


    }
}
