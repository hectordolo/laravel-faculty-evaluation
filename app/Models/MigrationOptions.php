<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MigrationOptions extends Model
{
    protected $table = 'migrate_options';

    protected $fillable = [
        'name',
        'status'
    ];
}
