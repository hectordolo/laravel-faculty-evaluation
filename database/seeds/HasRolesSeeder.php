<?php

use Illuminate\Database\Seeder;

class HasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1'
        ]);

        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '3'
        ]);

        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '4'
        ]);

        DB::table('role_user')->insert([
            'user_id' => '2',
            'role_id' => '7'
        ]);
    }
}
