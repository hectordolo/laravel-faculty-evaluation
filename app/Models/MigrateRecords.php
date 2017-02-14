<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MigrateRecords extends Model
{
    protected $table = 'migrated_records';

    protected $fillable = [
        'sjc_id',
        'subject_code',
        'section_code',
        'employee_code',
        'employee_name',
        'status',
        'semester',
        'school_year',
        'school_code',
        'evaluation'
    ];

    public function student()
    {
        return $this->belongsTo('App\User', 'sjc_id','sjc_id');
    }
}
