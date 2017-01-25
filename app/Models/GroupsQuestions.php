<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupsQuestions extends Model
{
    protected $table = 'questions_group';

    protected $fillable = [
        'question_id',
        'group_id',
        'priority'
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Questions', 'question_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Groups', 'group_id');
    }
}
