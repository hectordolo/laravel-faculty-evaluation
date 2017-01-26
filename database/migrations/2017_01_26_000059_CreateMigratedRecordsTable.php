<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigratedRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('migrated_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_code')->nullable();
            $table->string('subject_code')->nullable();
            $table->string('section_code')->nullable();
            $table->string('employee_code')->nullable();
            $table->integer('status')->nullable();
            $table->string('semester')->nullable();
            $table->string('school_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('migrated_records');
    }
}
