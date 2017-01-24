<?php

use Illuminate\Database\Seeder;

class QuestionsForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions_for')->insert([
            'id' => '1',
            'name' => 'FACULTY'
        ]);

        DB::table('questions_for')->insert([
            'id' => '2',
            'name' => 'DEAN'
        ]);
    }
}
