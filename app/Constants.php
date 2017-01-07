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

    public $validation_rules = [


        'name' => [
            'unique:constants',
            'required:constants',
            'regex:/^[a-zа-я\d-_]+$/',
            'max:255'
        ]
    ];
}
