<?php

namespace Corp;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Corp\User
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function articles(){

        return $this->hasMany('Corp\Article');

    }
}
