<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'metatags',
        'locale',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];
}
