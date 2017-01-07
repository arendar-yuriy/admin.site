<?php

namespace App;

use Dimsav\Translatable\Translatable;

class GalleryUnit extends Base
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
        'gallery_id',
        'name',
        'locale',
        'description',
        'cover',
        'image',
        'is_crop',
        'data_crop',
        'data_crop_info'
    ];

    protected $guarded = [
        'tags',
    ];


    public function folder(){
        return $this->belongsTo(Gallery::class,'gallery_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'tags_gallery_units','gallery_unit_id','tag_id');
    }

}
