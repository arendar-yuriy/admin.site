<?php

namespace App;

use App\Scopes\BasketTrait;
use App\Scopes\TimeTravel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use TimeTravel;
    use SoftDeletes;
    use LaratrustUserTrait; //
    use BasketTrait;
    protected $table = 'admin_users';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'image',
        'email',
        'password',
        'is_crop',
        'data_crop',
        'phone',
        'address',
        'city',
        'region',
        'country',
        'data_crop_info'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public $validation_rules = [


        'email' => [
            'required:admin_users',
            'email',
            'max:255'
        ],
        'roles' => [
            'required',
        ],
        'name' => [
            'required:admin_users',
            'max:255'
        ]

    ];

    public function getBy()
    {
        if(\Auth::user() !== null)
            return \Auth::user()->name . ' ' . \Auth::user()->lastname;

        return 'none';
    }

    public function log()
    {
        return $this->hasMany(Revision::class, 'admin_user_id');
    }
}