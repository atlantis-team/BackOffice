<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FirstName', 'LastName',
    ];

    /**
     * Get the devices for the user.
     */
    public function devices()
    {
        return $this->hasMany('App\Device', 'User_ID', 'ID');
    }
}
