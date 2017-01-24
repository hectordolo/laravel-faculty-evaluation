<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Start Questions Managements SEED
            DB::table('permissions')->insert([
                'id' => '1',
                'name' => 'questions-create',
                'display_name' => 'Create Questions',
                'description' => 'The user with this permission can create or add questions.'
            ]);
            DB::table('permissions')->insert([
                'id' => '2',
                'name' => 'questions-read',
                'display_name' => 'View Questions',
                'description' => 'The user with this permission can view the list of questions.'
            ]);
            DB::table('permissions')->insert([
                'id' => '3',
                'name' => 'questions-update',
                'display_name' => 'Edit Questions',
                'description' => 'The user with this permission can update or edit questions.'
            ]);
            DB::table('permissions')->insert([
                'id' => '4',
                'name' => 'questions-delete',
                'display_name' => 'Delete Questions',
                'description' => 'The user with this permission can delete or remove questions.'
            ]);
        //End Questions Managements SEED

        //Start Questions Managements SEED
            DB::table('permissions')->insert([
                'id' => '5',
                'name' => 'questions-group-create',
                'display_name' => 'Create Questions Group',
                'description' => 'The user with this permission can create or add questions group.'
            ]);
            DB::table('permissions')->insert([
                'id' => '6',
                'name' => 'questions-group-read',
                'display_name' => 'View Questions Group',
                'description' => 'The user with this permission can view the list of questions group.'
            ]);
            DB::table('permissions')->insert([
                'id' => '7',
                'name' => 'questions-group-update',
                'display_name' => 'Edit Questions Group',
                'description' => 'The user with this permission can update or edit questions group.'
            ]);
            DB::table('permissions')->insert([
                'id' => '8',
                'name' => 'questions-group-delete',
                'display_name' => 'Delete Questions Group',
                'description' => 'The user with this permission can delete or remove questions group.'
            ]);
        //End Questions Managements SEED

        //Start Questions For SEED
        DB::table('permissions')->insert([
            'id' => '9',
            'name' => 'questions-for-create',
            'display_name' => 'Create Questions For',
            'description' => 'The user with this permission can create or add questions for.'
        ]);
        DB::table('permissions')->insert([
            'id' => '10',
            'name' => 'questions-for-read',
            'display_name' => 'View Questions For',
            'description' => 'The user with this permission can view the list of questions for.'
        ]);
        DB::table('permissions')->insert([
            'id' => '11',
            'name' => 'questions-for-update',
            'display_name' => 'Edit Questions For',
            'description' => 'The user with this permission can update or edit questions for.'
        ]);
        DB::table('permissions')->insert([
            'id' => '12',
            'name' => 'questions-for-delete',
            'display_name' => 'Delete Questions For',
            'description' => 'The user with this permission can delete or remove questions for.'
        ]);
        //End Questions Managements SEED

        //Start USER MANAGEMENT SEED
        DB::table('permissions')->insert([
            'id' => '13',
            'name' => 'users-read',
            'display_name' => 'View Users',
            'description' => 'The user with this permission can view list of users.'
        ]);
        DB::table('permissions')->insert([
            'id' => '14',
            'name' => 'users-delete',
            'display_name' => 'Delete Users',
            'description' => 'The user with this permission can delete users.'
        ]);
        DB::table('permissions')->insert([
            'id' => '15',
            'name' => 'users-migrate',
            'display_name' => 'Migrate Users',
            'description' => 'The user with this permission can migrate users.'
        ]);

        //End USER MANAGEMENT SEED

        //Start Global Variable Management
        DB::table('permissions')->insert([
            'id' => '16',
            'name' => 'global-create',
            'display_name' => 'Create Global Variable',
            'description' => 'The user with this permission can create or add global variables.'
        ]);
        DB::table('permissions')->insert([
            'id' => '17',
            'name' => 'global-read',
            'display_name' => 'View Global Variable',
            'description' => 'The user with this permission can view the list of global variables.'
        ]);
        DB::table('permissions')->insert([
            'id' => '18',
            'name' => 'global-update',
            'display_name' => 'Edit Global Variable',
            'description' => 'The user with this permission can update or edit global variables.'
        ]);
        DB::table('permissions')->insert([
            'id' => '19',
            'name' => 'global-delete',
            'display_name' => 'Delete Global Variable',
            'description' => 'The user with this permission can delete or remove global variables.'
        ]);
        //End Questions Managements SEED
    }
}
