<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User;

return [
    'domain' => [
        'input_filter' => [
            Entity\User::class           =>
                [
                    'state'                  =>
                        [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                            ],
                            'validators' => [
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                                'Digits'   => [
                                    'name' => 'Digits',
                                ],
                                'Between'  => [
                                    'name'    => 'Between',
                                    'options' => [
                                        'min' => 0,
                                        'max' => PHP_INT_MAX,
                                    ],
                                ],
                            ],
                        ],
                    'email'                  =>
                        [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty'       => [
                                    'name' => 'NotEmpty',
                                ],
                                'EmailAddress'   => [
                                    'name' => 'EmailAddress',
                                ],
                                'StringLength'   => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 4,
                                        'max'      => 255,
                                    ],
                                ],
                                'NoObjectExists' => [
                                    'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                    'options' => [
                                        'entity_class' => Entity\User::class,
                                        'fields'       => ['email'],
                                        'messages'     => [
                                            'objectFound' => 'Email already exists!',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'firstName'              =>
                        [
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
                                        'max'      => 255,
                                    ],
                                ],
                            ],
                        ],
                    'lastName'               =>
                        [
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
                                        'max'      => 255,
                                    ],
                                ],
                            ],
                        ],
                    'timeZone'               =>
                        [
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
                                        'max'      => 255,
                                    ],
                                ],
                            ],

                        ],
                    'password'               =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StringTrim' => ['name' => 'StringTrim'],
                                'Null'       => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 6,
                                        'max'      => 255,
                                    ],
                                ],

                            ],
                        ],
                    'passwordResetToken'     =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StringTrim' => ['name' => 'StringTrim'],
                                'Null'       => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 6,
                                        'max'      => 255,
                                    ],
                                ],
                            ],

                        ],
                    'emailConfirmationToken' =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StringTrim' => ['name' => 'StringTrim'],
                                'Null'       => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 6,
                                        'max'      => 255,
                                    ],
                                ],
                            ],
                        ],
                    'failedLoginCount'       =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StringTrim' => ['name' => 'StringTrim'],
                            ],
                            'validators' => [
                                'Digits' => [
                                    'name' => 'Digits',
                                ],
                            ],
                        ],
                ],
            Entity\Acl\Permission::class =>
                [
                    'name'        =>
                        [
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
                                        'max'      => 255,
                                    ],
                                ],
                            ],
                        ],
                    'description' =>
                        [
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
                                        'max'      => 255,
                                    ],
                                ],
                            ],
                        ],
                    'isSystem'    =>
                        [
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
            Entity\Acl\Role::class       =>
                [
                    'name'        =>
                        [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'NotEmpty'       => [
                                    'name' => 'NotEmpty',
                                ],
                                'StringLength'   => [
                                    'name'    => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'min'      => 1,
                                        'max'      => 255,
                                    ],
                                ],
                                'NoObjectExists' => [
                                    'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                    'options' => [
                                        'entity_class' => Entity\Acl\Role::class,
                                        'fields'       => ['name'],
                                        'messages'     => [
                                            'objectFound' => 'Role already exists!',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'description' =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                            'validators' => [
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
                    'isDefault'   =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                            ],
                            'validators' => [
                                'Digits'  => [
                                    'name' => 'Digits',
                                ],
                                'Between' => [
                                    'name'    => 'Between',
                                    'options' => [
                                        'min' => 0,
                                        'max' => 1,
                                    ],
                                ],
                            ],
                        ],
                    'isSystem'    =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                            ],
                            'validators' => [
                                'Digits'  => [
                                    'name' => 'Digits',
                                ],
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
        ],
    ],
];
