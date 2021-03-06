<?php

namespace App;

use App\Scopes\BasketTrait;
use App\Scopes\TimeTravel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\LaratrustRole;

class Role extends LaratrustRole
{
    use TimeTravel;
    use SoftDeletes;
    use BasketTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getBy()
    {
        if(\Auth::user() !== null)
            return \Auth::user()->name . ' ' . \Auth::user()->lastname;

        return 'none';
    }
}
