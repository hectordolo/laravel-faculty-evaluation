<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionsGroup extends Model
{
    protected $table = 'questions_group';

    protected $fillable = [
        'question_id',
        'group_id',
        'priority'
    ];

}
