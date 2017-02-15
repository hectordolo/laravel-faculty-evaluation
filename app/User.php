<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sjc_id','first_name', 'last_name', 'school_code', 'password', 'username','type','school_of','course','semester','school_year'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = empty($value)
            ? $this->password
            : bcrypt($value);
    }

    public function setLastNameAttribute($value){
        $this->attributes['last_name'] = empty($value)
            ? $this->last_name
            : strtoupper($value);
    }

    public function setFirstNameAttribute($value){
        $this->attributes['first_name'] = empty($value)
            ? $this->last_name
            : strtoupper($value);
    }
}
