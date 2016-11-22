<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityUser\V1\Rest\User\UserResource::class => \ApigilityUser\V1\Rest\User\UserResourceFactory::class,
            \ApigilityUser\V1\Rest\Identity\IdentityResource::class => \ApigilityUser\V1\Rest\Identity\IdentityResourceFactory::class,
            \ApigilityUser\V1\Rest\Certification\CertificationResource::class => \ApigilityUser\V1\Rest\Certification\CertificationResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'apigility-user.rest.user' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/user[/:user_id]',
                    'defaults' => [
                        'controller' => 'ApigilityUser\\V1\\Rest\\User\\Controller',
                    ],
                ],
            ],
            'apigility-user.rest.identity' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/identity[/:identity_id]',
                    'defaults' => [
                        'controller' => 'ApigilityUser\\V1\\Rest\\Identity\\Controller',
                    ],
                ],
            ],
            'apigility-user.rest.certification' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/certification[/:certification_id]',
                    'defaults' => [
                        'controller' => 'ApigilityUser\\V1\\Rest\\Certification\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'apigility-user.rest.user',
            1 => 'apigility-user.rest.identity',
            2 => 'apigility-user.rest.certification',
        ],
    ],
    'zf-rest' => [
        'ApigilityUser\\V1\\Rest\\User\\Controller' => [
            'listener' => \ApigilityUser\V1\Rest\User\UserResource::class,
            'route_name' => 'apigility-user.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityUser\V1\Rest\User\UserEntity::class,
            'collection_class' => \ApigilityUser\V1\Rest\User\UserCollection::class,
            'service_name' => 'user',
        ],
        'ApigilityUser\\V1\\Rest\\Identity\\Controller' => [
            'listener' => \ApigilityUser\V1\Rest\Identity\IdentityResource::class,
            'route_name' => 'apigility-user.rest.identity',
            'route_identifier_name' => 'identity_id',
            'collection_name' => 'identity',
            'entity_http_methods' => [
                0 => 'PATCH',
                1 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'POST',
                1 => 'GET',
            ],
            'collection_query_whitelist' => [
                0 => 'phone',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityUser\V1\Rest\Identity\IdentityEntity::class,
            'collection_class' => \ApigilityUser\V1\Rest\Identity\IdentityCollection::class,
            'service_name' => 'identity',
        ],
        'ApigilityUser\\V1\\Rest\\Certification\\Controller' => [
            'listener' => \ApigilityUser\V1\Rest\Certification\CertificationResource::class,
            'route_name' => 'apigility-user.rest.certification',
            'route_identifier_name' => 'certification_id',
            'collection_name' => 'certification',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityUser\V1\Rest\Certification\CertificationEntity::class,
            'collection_class' => \ApigilityUser\V1\Rest\Certification\CertificationCollection::class,
            'service_name' => 'certification',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityUser\\V1\\Rest\\User\\Controller' => 'HalJson',
            'ApigilityUser\\V1\\Rest\\Identity\\Controller' => 'HalJson',
            'ApigilityUser\\V1\\Rest\\Certification\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'ApigilityUser\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.apigility-user.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityUser\\V1\\Rest\\Identity\\Controller' => [
                0 => 'application/vnd.apigility-user.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityUser\\V1\\Rest\\Certification\\Controller' => [
                0 => 'application/vnd.apigility-user.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'ApigilityUser\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.apigility-user.v1+json',
                1 => 'application/json',
            ],
            'ApigilityUser\\V1\\Rest\\Identity\\Controller' => [
                0 => 'application/vnd.apigility-user.v1+json',
                1 => 'application/json',
            ],
            'ApigilityUser\\V1\\Rest\\Certification\\Controller' => [
                0 => 'application/vnd.apigility-user.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \ApigilityUser\V1\Rest\User\UserEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-user.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityUser\V1\Rest\User\UserCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-user.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ],
            \ApigilityUser\V1\Rest\Identity\IdentityEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-user.rest.identity',
                'route_identifier_name' => 'identity_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityUser\V1\Rest\Identity\IdentityCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-user.rest.identity',
                'route_identifier_name' => 'identity_id',
                'is_collection' => true,
            ],
            \ApigilityUser\V1\Rest\Certification\CertificationEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-user.rest.certification',
                'route_identifier_name' => 'certification_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \ApigilityUser\V1\Rest\Certification\CertificationCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-user.rest.certification',
                'route_identifier_name' => 'certification_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'ApigilityUser\\V1\\Rest\\Identity\\Controller' => [
            'input_filter' => 'ApigilityUser\\V1\\Rest\\Identity\\Validator',
        ],
        'ApigilityUser\\V1\\Rest\\User\\Controller' => [
            'input_filter' => 'ApigilityUser\\V1\\Rest\\User\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'ApigilityUser\\V1\\Rest\\Session\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'max' => '11',
                            'min' => '11',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [
                            'charlist' => '',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\Filter\Digits::class,
                        'options' => [],
                    ],
                ],
                'name' => 'phone',
                'description' => '手机号码',
                'field_type' => 'string',
                'error_message' => '请输入手机号码',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'password',
                'description' => '密码',
                'error_message' => '请输入密码',
            ],
        ],
        'ApigilityUser\\V1\\Rest\\Identity\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => '用户标识。在创建资源时，是自动生成的，不需要输入。',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'phone',
                'description' => '手机号码',
                'field_type' => 'string',
                'allow_empty' => false,
                'error_message' => '请输入手机号码',
                'continue_if_empty' => true,
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'password',
                'description' => '用户密码',
                'field_type' => 'string',
                'error_message' => '请输入密码',
                'allow_empty' => false,
                'continue_if_empty' => true,
            ],
        ],
        'ApigilityUser\\V1\\Rest\\User\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'description' => '用户标识',
                'field_type' => 'string',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'nickname',
                'description' => '昵称',
                'error_message' => '请输入昵称',
                'field_type' => 'string',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'avatar',
                'description' => '头像',
                'field_type' => 'string',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'sex',
                'description' => '性别',
                'field_type' => 'int',
            ],
            4 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'age',
                'description' => '年龄',
            ],
            5 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'birthday',
                'description' => '生日',
                'error_message' => '请输入生日',
                'field_type' => 'timestamp',
            ],
            6 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'stature',
                'description' => '身高',
                'error_message' => '请输入身高',
                'field_type' => 'int',
            ],
            7 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'weight',
                'description' => '体重',
                'error_message' => '请输入体重',
                'field_type' => 'int',
            ],
            8 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'education',
                'description' => '学历',
                'field_type' => 'int',
                'error_message' => '请输入学历',
            ],
            9 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'emotion',
                'description' => '感情状况',
                'error_message' => '请输入感情状况',
                'field_type' => 'int',
            ],
            10 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'zodiac',
                'description' => '星座',
                'field_type' => 'int',
                'error_message' => '请输入星座',
            ],
            11 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'chinese_zodiac',
                'description' => '生肖',
                'field_type' => 'int',
                'error_message' => '请输入生肖',
            ],
            12 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'home_address',
                'description' => '家庭住址',
                'field_type' => 'int',
                'error_message' => '请输入家庭住址',
            ],
        ],
    ],
];
