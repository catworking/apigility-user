<?php
return [
    'ApigilityUser\\V1\\Rest\\User\\Controller' => [
        'description' => '用户',
        'collection' => [
            'description' => '用户信息列表',
            'GET' => [
                'description' => '获取所有用户的信息',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => '获取一个用户的信息',
            ],
            'PATCH' => [
                'description' => '修改用户信息',
            ],
        ],
    ],
    'ApigilityUser\\V1\\Rest\\Certification\\Controller' => [
        'description' => '用户实名认证信息',
    ],
    'ApigilityUser\\V1\\Rest\\Identity\\Controller' => [
        'description' => '创建一个用户标识。用于注册帐号。',
        'entity' => [
            'POST' => [
                'description' => '注册一个用户',
            ],
            'GET' => [
                'description' => '获取一个用户的所有标识',
            ],
            'PATCH' => [
                'description' => '修改一个用户的标识信息，如修改手机号码、第三方Oauth2标识（微信、QQ、微博）',
            ],
        ],
        'collection' => [
            'POST' => [
                'description' => '注册一个帐号。
这里并不是常规意义的注册帐号，仅仅是添加一个Oauth2用户标识，用户资料的创建需调用user资源。',
            ],
            'GET' => [
                'description' => '查找用户标识',
            ],
        ],
    ],
];
