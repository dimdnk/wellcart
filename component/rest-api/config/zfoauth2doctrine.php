<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

/**
 * The user entity is always stored in another namespace than ZF\OAuth2
 */
$userEntity = 'WellCart\User\Entity\User';
return [
    'default' => [
        'object_manager'          => 'doctrine.entitymanager.orm_default',
        'event_manager'           => 'doctrine.eventmanager.orm_default',
        'driver'                  => 'doctrine.driver.orm_default',
        'enable_default_entities' => false,
        'bcrypt_cost'             => 14, # match zfcuser
        'auth_identity_fields'    => ['email'],

        'mapping' => [
            'User' => [
                'entity' => $userEntity,
            ],

            'Client'      => [
                'entity' => 'WellCart\RestApi\Entity\OAuth2\Client',
            ],
            'AccessToken' => [
                'entity' => 'WellCart\RestApi\Entity\OAuth2\AccessToken',
            ],

            'RefreshToken' => [
                'entity' => 'WellCart\RestApi\Entity\OAuth2\RefreshToken',
            ],

            'AuthorizationCode' => [
                'entity' => 'WellCart\RestApi\Entity\OAuth2\AuthorizationCode',
            ],

            'Jwt' => [
                'entity' => 'WellCart\RestApi\Entity\OAuth2\Jwt',
            ],

            'Jti' => [
                'entity' => 'WellCart\RestApi\Entity\OAuth2\Jti',
            ],

            'Scope' => [
                'entity' => 'WellCart\RestApi\Entity\OAuth2\Scope',
            ],

            'PublicKey' => [
                'entity' => 'WellCart\RestApi\Entity\OAuth2\PublicKey',
            ],
        ],
    ],
];
