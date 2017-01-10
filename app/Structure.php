<?php

namespace App;

use Dimsav\Translatable\Translatable;

class Structure extends Tree
{
    use Translatable;

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
        'parent_id',
        'alias_en',
        'alias_customer',
        'alias_priority',
        'position',
        'controller',
        'by_position',
        'name',
        'menu_level',
        'description',
        'metatags',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];

    public function contents()
    {
        return $this->belongsToMany(Content::class,'content_structure','structure_id','content_id');
    }

    public function gallery(){
        return $this->hasOne(Gallery::class,'structure_id');
    }
}
