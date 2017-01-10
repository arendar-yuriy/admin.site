<?php

namespace App;

class Constants extends Base
{
    protected $table = 'constants';

    protected $fillable = [
        'published',
        'group',
        'type',
        'name',
        'description',
        'values',
        'value',
    ];
}
