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

    public function articles()
    {
        return $this->hasMany('Corp\Article');
    }

    public function roles()
    {
        return $this->belongsToMany('Corp\Role', 'role_user');
    }

    // may be 'string' or array()
    public function canDo($permission, $require = false)
    {
        if(is_array($permission))
        {
            foreach($permission as $permName)
            {
                $canDo = $this->canDo($permName);
                if($canDo && !$require)
                {
                    return true;
                }
                elseif(!$canDo && $require)
                {
                    return false;
                }
            }
            return $require;
        }
        else
        {
            foreach($this->roles as $role)
            {
                foreach($role->perms as $perm)
                {
                    if(str_is($permission, $perm->name))
                    {
                        return true;
                    }
                }
            }
        }
        //!!!!!
        return false;
    }

    // may be 'string' or array()
    public function hasRole($name, $require = false)
    {
        if(is_array($name))
        {
            foreach($name as $roleName)
            {
                $hasRole = $this->canDo($roleName);
                if($hasRole && !$require)
                {
                    return true;
                }
                elseif(!$hasRole && $require)
                {
                    return false;
                }
            }
            return $require;
        }
        else
        {
                    foreach($this->roles as $role)
                    {
                            if($role->name == $name)
                            {
                                return true;
                            }
                    }
        }
        return false;
    }
}
