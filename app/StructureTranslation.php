<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StructureTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'locale',
        'name',
        'menu_level',
        'description',
        'metatags',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];
}
