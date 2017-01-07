<?php
namespace App\Scopes;

trait ScopesTrait
{

    public function scopePublished($query)
    {
        return $query->where('published',1);
    }

}