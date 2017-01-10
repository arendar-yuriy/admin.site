<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'basket';

    protected $fillable = [
        'admin_user_id',
        'basketable_type',
        'admin_user_name',
        'basketable_id',
        'basket_name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function basketable()
    {
        return $this->morphTo();
    }
}
