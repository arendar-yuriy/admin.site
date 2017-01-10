<?php

namespace App;

class SiteUser extends Base
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'lastname',
        'phone',
        'address',
        'city',
        'region',
        'country',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function socials()
    {
        return $this->hasMany(UserSocial::class,'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class,'user_id');
    }
}
