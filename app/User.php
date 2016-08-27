<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmed', 'confirmation_code', 'role', 'description', 'birthday', 'fb_link'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id');
    }

    //Tao method kiem tra isAdmin
    public function isAdmin()
    {
        if ($this->role === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isAuthor()
    {
        if ($this->role === 2) {
            return true;
        } else {
            return false;
        }
    }


}
