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
        'input_filter' => [
            Entity\OAuth2\PublicKey::class => [
                'client' => [
                        'required' => true,
                ],
                'encryptionAlgorithm' => [
                        'required' => true,
                ],
                'publicKey' =>
                    [
                            'required' => true,
                            'filters' => [
                                'StringToLower' => ['name' => 'StringToLower'],
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                                'StringLength' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min' => 1,
                                        'max' => 255,
                                    ],
                                ],
                            ],
                    ],
                'privateKey' =>
                    [
                            'required' => true,
                            'filters' => [
                                'StringToLower' => ['name' => 'StringToLower'],
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                                'StringLength' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min' => 1,
                                        'max' => 255,
                                    ],
                                ],
                            ],
                    ],
            ],


            Entity\OAuth2\Client::class => [
                'user' =>
                    [
                            'required' => true,
                            'filters' => [
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                        ],
                    ],
                'clientId' =>
                    [
                            'required' => true,
                            'filters' => [
                                'StringToLower' => ['name' => 'StringToLower'],
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                                'StringLength' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min' => 1,
                                        'max' => 255,
                                    ],
                                ],

                                [
                                    'name' => 'WellCart\ORM\Validator\NoObjectExists',
                                    'options' => [
                                        'entity_class' => Entity\OAuth2\Client::class,
                                        'fields' => ['client_id'],
                                        'messages' => [
                                            'objectFound' => 'Client ID already exists!'
                                        ],
                                    ],
                                ],
                            ],
                    ],

                'newSecret' =>
                    [
                            'required' => true,
                            'filters' => [
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min' => 6,
                                    ],
                                ],
                            ],
                    ],

                'newSecretVerify' =>
                    [
                            'required' => true,
                            'filters' => [
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min' => 6,
                                    ],
                                ],
                                'Identical' => [
                                    'name' => 'Identical',
                                    'options' => [
                                        'token' => 'new_secret'
                                    ]
                                ],
                            ],
                    ],

                'redirectUri' =>
                    [
                            'required' => false,
                            'filters' => [
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min' => 10,
                                        'max' => 255,
                                    ],
                                ],
                                'Uri' => [
                                    'name' => 'Uri',
                                    'options' => [
                                        'allow_relative' => false,
                                    ],
                                ],
                            ],
                    ],
            ],

            Entity\OAuth2\Scope::class => [
                    'isDefault' =>
                        [
                                'required' => false,
                                'filters' => [
                                    'StripTags' => ['name' => 'StripTags'],
                                    'StringTrim' => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                ],
                                'validators' => [
                                    'Between' => [
                                        'name' => 'Between',
                                        'options' => [
                                            'min' => 0,
                                            'max' => 1,
                                        ],
                                    ],
                                ],
                        ],
                    'scope' =>
                        [
                                'required' => true,
                                'filters' => [
                                    'StripTags' => ['name' => 'StripTags'],
                                    'StringTrim' => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null' => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty' => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name' => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min' => 1,
                                            'max' => 50,
                                        ],
                                    ],

                                    [
                                        'name' => 'WellCart\ORM\Validator\NoObjectExists',
                                        'options' => [
                                            'entity_class' => Entity\OAuth2\Scope::class,
                                            'fields' => ['scope'],
                                            'messages' => [
                                                'objectFound' => 'Scope already exists!'
                                            ],
                                        ],
                                    ],
                                ],
                        ],
            ],
        ],
    ],
];
