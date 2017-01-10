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

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(SiteUser::class);
    }
}
