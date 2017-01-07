<?php

namespace App;

use Dimsav\Translatable\Translatable;

class SliderUnits extends Base
{
    use Translatable;

    public $translatedAttributes = [
        'name',
        'locale',
        'description',
    ];
    protected $fillable = [
        'published',
        'position',
        'slider_id',
        'name',
        'locale',
        'description',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];

    public $validation_rules = [
        'name' => [
            'required',
            'max:255'
        ]
    ];


    public function slider(){
        return $this->belongsTo(Sliders::class);
    }

}
