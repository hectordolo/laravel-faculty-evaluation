<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MigrateRecords extends Model
{
    protected $table = 'migrated_records';

    protected $fillable = [
        'student_code',
        'subject_code',
        'section_code',
        'employee_code',
        'status',
        'semester',
        'school_year'
    ];
}
