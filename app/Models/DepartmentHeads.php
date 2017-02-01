<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentHeads extends Model
{
    protected $table = 'department_heads';

    protected $fillable = [
        'faculty_id',
        'dean_id',
        'status',
        'evaluation'
    ];

}
