<?php

namespace App;

class Tag extends Base
{
    protected $table = 'tags';

    protected $fillable = [
        'published',
        'alias',
        'text'
    ];

    public function contents(){
        return $this->belongsToMany(Content::class,'tags_contents','tag_id','content_id');
    }

    public function units(){
        return $this->belongsToMany(GalleryUnit::class,'tags_gallery_units','tag_id','gallery_unit_id');
    }
}
