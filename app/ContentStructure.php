<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentStructure extends Model
{
    public $timestamps = false;

    protected $table = 'content_structure';
    protected $fillable = [
        'content_id',
        'structure_id',
        'position',
    ];
}
