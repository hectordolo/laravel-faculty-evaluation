<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name',
        'percentage',
        'priority',
        'active',
        'for_id'
    ];

    public function questions_for()
    {
        return $this->belongsTo('App\Models\QuestionsFor', 'for_id');
    }

}
