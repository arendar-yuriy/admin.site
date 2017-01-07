<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderUnitsTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'locale',
        'description',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];

}
