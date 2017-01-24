<?php

use Illuminate\Database\Seeder;

class GlobalVariablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('global_variables')->insert([
            'id' => '1',
            'name' => 'semester',
            'value' => '2'
        ]);
        DB::table('global_variables')->insert([
            'id' => '2',
            'name' => 'school_year',
            'value' => '2016-2017'
        ]);
    }
}
