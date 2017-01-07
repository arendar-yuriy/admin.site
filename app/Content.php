<?php

namespace App;

use Dimsav\Translatable\Translatable;

class Content extends Base
{
    use Translatable;

    public $translatedAttributes = [
        'name',
        'locale',
        'description',
        'text',
        'metatags',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];
    protected $fillable = [
        'published',
        'alias',
        'alias_ru',
        'alias_en',
        'alias_priority',
        'type',
        'position',
        'level',
        'name',
        'description',
        'text',
        'date_published',
        'metatags',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];

    protected $guarded = [
        'tags',
    ];

    public $validation_rules = [
        'alias'=>[
            'regex:/^[a-zа-я\d-]+$/',
            'max:255'
        ],

        'alias_customer'=>[
            'regex:/^[a-zа-я\d-]+$/',
            'max:255'
        ],

        'name' => [
            'required:contents',
            'max:255'
        ]
    ];

    public function structures(){
        return $this->belongsToMany(Structure::class,'content_structure','content_id','structure_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tags_contents','content_id','tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function releted()
    {
        return $this->hasMany(ContentStructure::class);
    }
}
