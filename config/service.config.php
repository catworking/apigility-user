<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/16
 * Time: 14:52
 */
return [
    'service_manager' => array(
        'factories' => array(
            'ApigilityUser\Service\IdentityService' => 'ApigilityUser\Service\IdentityServiceFactory',
        ),
    )
];