<?php

namespace App;

class SiteUserLog extends Base
{
    protected $table = 'user_log';

    protected $fillable = [
        'action',
        'url',
        'user_id',
        'locale',
        'browser',
        'browser',
        'os',
        'ip',
    ];
}
