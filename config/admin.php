<?php

return [
    'content_type'=>[
        'pages'=>[
            'label'=>'info',
            'name'=>'page'
        ],
        'blocks'=>[
            'label'=>'default',
            'name'=>'text block'
        ],
        'news'=>[
            'label'=>'success',
            'name'=>'item'
        ],
        'articles'=>[
            'label'=>'primary',
            'name'=>'article'
        ],

    ],
    'menu_levels'=>[
        'top',
        'left',
        'right',
        'bottom'
    ],
    'image_url'=>env('IMG_URL'),

    'status_feedback'=>[
        'new'=>[
          'bg'=>'bg-danger',
            'name'=>'New',
        ],
        'later'=>[
            'bg'=>'bg-info',
            'name'=>'Read later'
        ],
        'already'=>[
            'bg'=>'bg-success',
            'name'=>'Already'
        ],
        'answer'=>[
            'bg'=>'bg-primary',
            'name'=>'Need answer'
        ],
    ],

    'status_comments'=>[
        'new'=>[
            'bg'=>'bg-danger',
            'name'=>'New',
        ],
        'confirmed'=>[
            'bg'=>'bg-success',
            'name'=>'Confirmed'
        ],
        'denied'=>[
            'bg'=>'bg-warning',
            'name'=>'Denied'
        ],
    ],

    'meta'=>[
        'content'=>[
            '{name}'=>'Name',
            '{site}'=>'Site',
            '{description}'=>'Description',
            '{structure_name}'=>'Name Structure',
            '{date}'=>'Date',
        ],
        'structure'=>[
            '{name}'=>'Name',
            '{site}'=>'Site',
            '{description}'=>'Description',
        ],
        'gallery'=>[
            '{name}'=>'Name',
            '{site}'=>'Site',
            '{description}'=>'Description',
            '{date}'=>'Date',
        ],
    ],

    'constants_group' =>[
        'text' => 'Text constants',
        'client' => 'User data',
        'system' => 'System',
        'seo' => 'Seo',
        'social' => 'Social networks',
        'meta' => 'Meta tags',
        'site_settings' => 'Site settings',
        'admin_settings' => 'Admin panel settings'
    ],
    'constants_type' => [
        'string' => 'String',
        'enumeration' => 'Enumeration',
        'array' => 'Array',
        'multiplicity' => 'Multiplicity',
        'file' => 'File',
        'boolean' => 'Selector',
        'time' => 'Time',
        'date' => 'Date',
        'date_time' => 'Date time',
    ],
    'social_icons'=>[
        'Google Plus'=>'icon-google-plus2',
        'Facebook'=>'icon-facebook2',
        'Linkedin'=>'icon-linkedin',
        'Vkontakte'=>'fa fa-vk',
        'GitHub'=>'icon-github'
    ]
];