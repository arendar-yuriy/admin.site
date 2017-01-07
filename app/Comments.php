<?php

namespace App;

class Comments extends Tree
{
    protected $fillable = [
        'status',
        'user_id',
        'content_id',
        'parent_id',
        'type',
        'name',
        'email',
        'company',
        'name',
        'social_network',
        'site',
        'comment',
        'locale',
        'url',
        'browser',
        'os',
        'ip',
    ];


    public $validation_rules = [

        'comment' => [
            'required:comments',
            'min:10'
        ],
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(SiteUser::class);
    }
}
