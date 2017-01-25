<?php

use Illuminate\Database\Seeder;

class GroupsQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions_group')->insert([
            'id' => '1',
            'question_id' => '41',
            'group_id' => '5',
            'priority' => '1'
        ]);

        DB::table('questions_group')->insert([
            'id' => '2',
            'question_id' => '42',
            'group_id' => '5',
            'priority' => '2'
        ]);

        DB::table('questions_group')->insert([
            'id' => '3',
            'question_id' => '43',
            'group_id' => '5',
            'priority' => '3'
        ]);

        DB::table('questions_group')->insert([
            'id' => '4',
            'question_id' => '44',
            'group_id' => '5',
            'priority' => '4'
        ]);

        DB::table('questions_group')->insert([
            'id' => '5',
            'question_id' => '45',
            'group_id' => '5',
            'priority' => '5'
        ]);

        DB::table('questions_group')->insert([
            'id' => '6',
            'question_id' => '46',
            'group_id' => '5',
            'priority' => '6'
        ]);

        DB::table('questions_group')->insert([
            'id' => '7',
            'question_id' => '47',
            'group_id' => '5',
            'priority' => '7'
        ]);

        DB::table('questions_group')->insert([
            'id' => '8',
            'question_id' => '48',
            'group_id' => '5',
            'priority' => '8'
        ]);

        DB::table('questions_group')->insert([
            'id' => '9',
            'question_id' => '49',
            'group_id' => '5',
            'priority' => '9'
        ]);

        DB::table('questions_group')->insert([
            'id' => '10',
            'question_id' => '50',
            'group_id' => '5',
            'priority' => '10'
        ]);

        DB::table('questions_group')->insert([
            'id' => '11',
            'question_id' => '51',
            'group_id' => '5',
            'priority' => '11'
        ]);

        DB::table('questions_group')->insert([
            'id' => '12',
            'question_id' => '52',
            'group_id' => '5',
            'priority' => '12'
        ]);

        DB::table('questions_group')->insert([
            'id' => '13',
            'question_id' => '53',
            'group_id' => '5',
            'priority' => '13'
        ]);

        DB::table('questions_group')->insert([
            'id' => '14',
            'question_id' => '54',
            'group_id' => '5',
            'priority' => '14'
        ]);

        DB::table('questions_group')->insert([
            'id' => '15',
            'question_id' => '55',
            'group_id' => '5',
            'priority' => '15'
        ]);

        DB::table('questions_group')->insert([
            'id' => '16',
            'question_id' => '56',
            'group_id' => '5',
            'priority' => '16'
        ]);

        DB::table('questions_group')->insert([
            'id' => '17',
            'question_id' => '57',
            'group_id' => '5',
            'priority' => '17'
        ]);

        DB::table('questions_group')->insert([
            'id' => '18',
            'question_id' => '58',
            'group_id' => '6',
            'priority' => '1'
        ]);

        DB::table('questions_group')->insert([
            'id' => '19',
            'question_id' => '59',
            'group_id' => '6',
            'priority' => '2'
        ]);

        DB::table('questions_group')->insert([
            'id' => '20',
            'question_id' => '60',
            'group_id' => '6',
            'priority' => '3'
        ]);

        DB::table('questions_group')->insert([
            'id' => '21',
            'question_id' => '61',
            'group_id' => '7',
            'priority' => '1'
        ]);

        DB::table('questions_group')->insert([
            'id' => '22',
            'question_id' => '62',
            'group_id' => '7',
            'priority' => '2'
        ]);

        DB::table('questions_group')->insert([
            'id' => '23',
            'question_id' => '63',
            'group_id' => '7',
            'priority' => '3'
        ]);

        DB::table('questions_group')->insert([
            'id' => '24',
            'question_id' => '64',
            'group_id' => '7',
            'priority' => '4'
        ]);
    }
}
