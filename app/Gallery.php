<?php

namespace App;

use Dimsav\Translatable\Translatable;

class Gallery extends Tree
{
    use Translatable;

    protected $table = 'galleries';

    public $translatedAttributes = [
        'name',
        'locale',
        'description',
        'metatags',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];
    protected $fillable = [
        'published',
        'alias_ru',
        'alias_en',
        'by_position',
        'parent_id',
        'structure_id',
        'alias_priority',
        'position',
        'name',
        'description',
        'metatags',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];

    protected $guarded = [
        'tags',
    ];

    public function structure()
    {
        return $this->belongsMany(Structure::class,'structure_id');
    }

    public function units(){
        return $this->hasMany(GalleryUnit::class,'gallery_id');
    }
}
