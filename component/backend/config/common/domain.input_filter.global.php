<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Backend;

return [
    'domain' => [
        'input_filter' => [
            Entity\Administrator::class =>
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
                                        'entity_class' => Entity\Administrator::class,
                                        'fields'       => ['email'],
                                        'messages'     => [
                                            'objectFound' => 'Account with this email already exists!',
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

            Entity\Notification::class =>
                [
                    'icon'      =>
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
                                        'max'      => 100,
                                    ],
                                ],
                            ],
                        ],
                    'title'     =>
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
                    'body'      =>
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
                                        'max'      => 512,
                                    ],
                                ],
                            ],
                        ],
                    'isRead'    =>
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
                    'isDeleted' =>
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
        ],
    ],
];
