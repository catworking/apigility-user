<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 16:32
 */
return [
    'apigility-user' => [
        'ease-mob' => [
            'enable'=>false,
            'app_key'=>'',
            'client_id'=>'',
            'client_secret'=>'',
            'server_url'=>'',
            'account_register_password'=>'',
            'cache_path'=>''
        ],
    ],
    'zf-mvc-auth' => [
        'authentication' => [
            'map' => [
                'ApigilityUser\\V1' => 'apigilityoauth2adapter',
            ],
        ],
    ],
];