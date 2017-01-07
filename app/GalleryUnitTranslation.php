<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryUnitTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'locale',
        'description',
        'cover',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];

}
