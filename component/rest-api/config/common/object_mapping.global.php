<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\RestApi;

return [
    'object_mapping' => [
        Entity\OAuth2\PublicKey::class => [
            'formFields' => [
                'client'              => [
                    'input_filter_specification' => [
                        'required' => true,
                    ],
                ],
                'encryptionAlgorithm' => [
                    'input_filter_specification' => [
                        'required' => true,
                    ],
                ],
                'publicKey'           =>
                    [
                        'input_filter_specification' => [
                            'required'   => true,
                            'filters'    => [
                                'StringToLower' => ['name' => 'StringToLower'],
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty'     => [
                                    'name' => 'NotEmpty',
                                ],
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 1,
                                        'max'      => 255,
                                    ],
                                ],
                            ],
                        ],
                    ],
                'privateKey'          =>
                    [
                        'input_filter_specification' => [
                            'required'   => true,
                            'filters'    => [
                                'StringToLower' => ['name' => 'StringToLower'],
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty'     => [
                                    'name' => 'NotEmpty',
                                ],
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 1,
                                        'max'      => 255,
                                    ],
                                ],
                            ],
                        ],
                    ],
            ]
        ],


        Entity\OAuth2\Client::class => [
            'formFields' => [
                'user'     =>
                    [
                        'input_filter_specification' => [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                            ],
                        ],
                    ],
                'clientId' =>
                    [
                        'input_filter_specification' => [
                            'required'   => true,
                            'filters'    => [
                                'StringToLower' => ['name' => 'StringToLower'],
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty'     => [
                                    'name' => 'NotEmpty',
                                ],
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 1,
                                        'max'      => 255,
                                    ],
                                ],

                                [
                                    'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                    'options' => [
                                        'entity_class' => Entity\OAuth2\Client::class,
                                        'fields'       => ['client_id'],
                                        'messages'     => [
                                            'objectFound' => 'Client ID already exists!'
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],

                'newSecret' =>
                    [
                        'input_filter_specification' => [
                            'required'   => true,
                            'filters'    => [
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 6,
                                    ],
                                ],
                            ],
                        ],
                    ],

                'newSecretVerify' =>
                    [
                        'input_filter_specification' => [
                            'required'   => true,
                            'filters'    => [
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 6,
                                    ],
                                ],
                                'Identical'    => [
                                    'name'    => 'Identical',
                                    'options' => [
                                        'token' => 'new_secret'
                                    ]
                                ],
                            ],
                        ],
                    ],

                'redirectUri' =>
                    [
                        'input_filter_specification' => [
                            'required'   => false,
                            'filters'    => [
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 10,
                                        'max'      => 255,
                                    ],
                                ],
                                'Uri'          => [
                                    'name'    => 'Uri',
                                    'options' => [
                                        'allow_relative' => false,
                                    ],
                                ],
                            ],
                        ],
                    ],


            ],
        ],

        Entity\OAuth2\Scope::class => [
            'fields' => [
                'isDefault' =>
                    [
                        'column'                     => 'is_default',
                        'type'                       => 'boolean',
                        'nullable'                   => false,
                        'input_filter_specification' => [
                            'required'   => false,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                            ],
                            'validators' => [
                                'Between' => [
                                    'name'    => 'Between',
                                    'options' => [
                                        'min' => 0,
                                        'max' => 1,
                                    ],
                                ],
                            ],
                        ],
                    ],
                'scope'     =>
                    [
                        'input_filter_specification' => [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty'     => [
                                    'name' => 'NotEmpty',
                                ],
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 1,
                                        'max'      => 50,
                                    ],
                                ],

                                [
                                    'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                    'options' => [
                                        'entity_class' => Entity\OAuth2\Scope::class,
                                        'fields'       => ['scope'],
                                        'messages'     => [
                                            'objectFound' => 'Scope already exists!'
                                        ],
                                    ],
                                ],
                            ],
                        ],
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
];
