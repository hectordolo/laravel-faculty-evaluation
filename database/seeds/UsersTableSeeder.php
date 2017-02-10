<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'sjc_id' => '2014111701',
            'last_name' => 'DOLO',
            'first_name' => 'HECTOR',
            'username' => '2014111701',
            'password' => bcrypt('2014111701'),
            'school_code' => '',
            'type' => 'EMPLOYEE'
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'sjc_id' => '2016051608',
            'last_name' => 'WOO',
            'first_name' => 'RAMON',
            'username' => '2016051608',
            'password' => bcrypt('2016051608'),
            'school_code' => '',
            'type' => 'EMPLOYEE'
        ]);
    }
}
