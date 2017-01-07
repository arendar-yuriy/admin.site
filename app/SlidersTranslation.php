<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlidersTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'published',
        'alias',
        'locale',
        'structure_id',
        'position',
        'name',
        'description',
    ];
}
