<?php

use Illuminate\Database\Seeder;

class HasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Start QUESTIONS MANAGEMENT FOR SYSTEM ADMINISTRATOR
            DB::table('permission_role')->insert([
                'permission_id' => '1',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '2',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '3',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '4',
                'role_id' => '1'
            ]);
        //End QUESTIONS MANAGEMENT FOR SYSTEM ADMINISTRATOR

        //Start QUESTIONS GROUP MANAGEMENT FOR SYSTEM ADMINISTRATOR
            DB::table('permission_role')->insert([
                'permission_id' => '5',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '6',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '7',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '8',
                'role_id' => '1'
            ]);
        //End QUESTIONS GROUP MANAGEMENT FOR SYSTEM ADMINISTRATOR

        //Start QUESTIONS FOR MANAGEMENT FOR SYSTEM ADMINISTRATOR
            DB::table('permission_role')->insert([
                'permission_id' => '9',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '10',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '11',
                'role_id' => '1'
            ]);
            DB::table('permission_role')->insert([
                'permission_id' => '12',
                'role_id' => '1'
            ]);
        //End QUESTIONS FOR MANAGEMENT FOR SYSTEM ADMINISTRATOR

        //Start USER MANAGEMENT FOR SYSTEM ADMINISTRATOR
        DB::table('permission_role')->insert([
            'permission_id' => '13',
            'role_id' => '1'
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '14',
            'role_id' => '1'
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '15',
            'role_id' => '1'
        ]);
        //End QUESTIONS FOR MANAGEMENT FOR SYSTEM ADMINISTRATOR

        //Start USER MANAGEMENT FOR USER MANAGER
        DB::table('permission_role')->insert([
            'permission_id' => '13',
            'role_id' => '2'
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '14',
            'role_id' => '2'
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '15',
            'role_id' => '2'
        ]);
        //End QUESTIONS FOR MANAGEMENT FOR USER MANAGER

        //Start Global Variable FOR SYSTEM ADMINISTRATOR
        DB::table('permission_role')->insert([
            'permission_id' => '16',
            'role_id' => '1'
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '17',
            'role_id' => '1'
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '18',
            'role_id' => '1'
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => '19',
            'role_id' => '1'
        ]);
        //End Global Variable FOR SYSTEM ADMINISTRATOR
    }
}
