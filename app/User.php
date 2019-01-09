<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'password', 'role_id', 'squadron_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles))
        {
            foreach ($roles as $r)
            {
                if ($this->hasRole($r))
                    return true;
            }
        }
        else
            if ($this->hasRole($roles))
                return true;

        return false;
    }

    public function hasRole($role)
    {
        if ($this->role->name == $role)
            return true;

        return false;
    }
}
