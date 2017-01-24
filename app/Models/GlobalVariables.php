<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalVariables extends Model
{
    protected $table = 'global_variables';

    protected $fillable = [
        'name',
        'value'
    ];

}
