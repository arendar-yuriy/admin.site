<?php
namespace App\Scopes;

use App\Basket;

trait BasketTrait
{

    /**
     * @return mixed
     */
    public function baskets()
    {
        return $this->morphMany(Basket::class, 'basketable');
    }
}