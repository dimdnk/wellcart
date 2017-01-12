<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\RestApi;

return [
    'domain' => [
        'mapping' => [
            Entity\OAuth2\Scope::class => [
                'fields' => [
                    'isDefault' =>
                        [
                            'column'   => 'is_default',
                            'type'     => 'boolean',
                            'nullable' => false,
                        ],
                ],
            ],

            'WellCart\User\Entity\User' =>
                [
                    'oneToMany' => [
                        'client'            => [
                            'targetEntity' => Entity\OAuth2\Client::class,
                            'mappedBy'     => 'user',
                            'joinColumn'   => [
                                'name'                 => 'oauth_client_id',
                                'referencedColumnName' => 'id',
                            ],
                        ],
                        'accessToken'       => [
                            'targetEntity' => Entity\OAuth2\AccessToken::class,
                            'mappedBy'     => 'user',
                            'joinColumn'   => [
                                'name'                 => 'oauth_access_token_id',
                                'referencedColumnName' => 'id',
                            ],
                        ],
                        'authorizationCode' => [
                            'targetEntity' => Entity\OAuth2\AuthorizationCode::class,
                            'mappedBy'     => 'user',
                            'joinColumn'   => [
                                'name'                 => 'oauth_authorization_code_id',
                                'referencedColumnName' => 'id',
                            ],
                        ],
                        'refreshToken'      => [
                            'targetEntity' => Entity\OAuth2\RefreshToken::class,
                            'mappedBy'     => 'user',
                            'joinColumn'   => [
                                'name'                 => 'oauth_refresh_token_id',
                                'referencedColumnName' => 'id',
                            ],
                        ],
                    ],
                ],
        ],
    ],
];
