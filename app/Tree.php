<?php

namespace App;

use App\Scopes\BasketTrait;
use App\Scopes\TimeTravel;
use App\Scopes\ScopesTrait;
use Kalnoy\Nestedset\NodeTrait;

class Tree extends Base
{
    use TimeTravel;
    use BasketTrait;
    use ScopesTrait;
    use NodeTrait;
    /**
     * validation rules for current model
     * @var array
     */
    public $validation_rules = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getBy()
    {
        return \Auth::user()->name . ' ' . \Auth::user()->lastname;
    }
}
