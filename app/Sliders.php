<?php

namespace App;

use Dimsav\Translatable\Translatable;

class Sliders extends Base
{
    use Translatable;

    public $translatedAttributes = [
        'name',
        'locale',
        'description',
    ];
    protected $fillable = [
        'published',
        'alias',
        'structure_id',
        'position',
        'name',
        'description',
    ];

    public $validation_rules = [
        'alias'=>[
            'regex:/^[a-zа-я\d-]+$/',
            'max:255'
        ],
        'name' => [
            'required',
            'max:255'
        ]
    ];

    public function units()
    {
        return $this->hasMany(SliderUnits::class,'slider_id');
    }
}
