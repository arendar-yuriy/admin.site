<?php

namespace App;

class Feedback extends Base
{
    protected $table = 'feedback';

    protected $fillable = [
        'status',
        'name',
        'email',
        'phone',
        'subject',
        'company',
        'site',
        'content',
        'answer',
        'browser',
        'url',
        'os',
        'ip',
    ];

}
