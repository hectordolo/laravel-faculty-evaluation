<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(HasPermissionsSeeder::class);
        $this->call(HasRolesSeeder::class);
        $this->call(QuestionsForSeeder::class);
        $this->call(GlobalVariablesSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(GroupsQuestionsSeeder::class);
        $this->call(MigrationOptionsTableSeeder::class);
    }
}
