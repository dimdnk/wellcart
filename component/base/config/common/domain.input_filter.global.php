<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;

return [
    'domain' => [
        'input_filter' => [
            Entity\Configuration::class   =>
                [
                    'configKey'   =>
                        [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'StringTrim'    => ['name' => 'StringTrim'],
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
                                        'entity_class' => Entity\Configuration::class,
                                        'fields'       => ['configKey'],
                                        'messages'     => [
                                            'objectFound' => 'Config key already exists!',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'configValue' =>
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
                    'context'     =>
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
                                        'max'      => 15,
                                    ],
                                ],
                            ],
                        ],
                    'environment' =>
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
                                        'max'      => 15,
                                    ],
                                ],
                            ],
                        ],

                ],
            Entity\UrlRewrite::class      =>
                [
                    'requestPath' =>
                        [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => [
                                    'name'    => 'StringTrim',
                                    'options' => ['charlist' => '/'],
                                ],
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
                                        'entity_class' => Entity\UrlRewrite::class,
                                        'fields'       => ['requestPath'],
                                        'messages'     => [
                                            'objectFound' => 'Request path already exists!',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'targetPath'  =>
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
            Entity\Locale\Language::class =>
                [
                    'name'      =>
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
                                        'min'      => 2,
                                        'max'      => 255,
                                    ],
                                ],
                                'NoObjectExists' => [
                                    'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                    'options' => [
                                        'entity_class' => Entity\Locale\Language::class,
                                        'fields'       => ['name'],
                                        'messages'     => [
                                            'objectFound' => 'Language already exists!',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'code'      =>
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
                                        'max'      => 3,
                                    ],
                                ],
                                'NoObjectExists' => [
                                    'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                    'options' => [
                                        'entity_class' => Entity\Locale\Language::class,
                                        'fields'       => ['code'],
                                        'messages'     => [
                                            'objectFound' => 'Language code already exists!',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'locale'    =>
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
                                        'min'      => 2,
                                        'max'      => 6,
                                    ],
                                ],
                            ],
                        ],
                    'territory' =>
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
                                        'max'      => 3,
                                    ],
                                ],
                            ],

                        ],
                    'isSystem'  =>
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
                    'isDefault' =>
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
                    'isActive'  =>
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
                    'sortOrder' =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                            ],
                            'validators' => [
                                'Digits' => [
                                    'name' => 'Digits',
                                ],
                            ],
                        ],

                ],
            Entity\Queue\Job::class       =>
                [
                    'queue'   =>
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
                                        'max'      => 64,
                                    ],
                                ],
                            ],
                        ],
                    'data'    =>
                        [
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
                    'message' =>
                        [
                            'required' => false,
                            'filters'  => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                        ],
                    'trace'   =>
                        [
                            'required' => false,
                            'filters'  => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                            ],
                        ],
                    'status'  =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                            ],
                            'validators' => [
                                'Digits' => [
                                    'name' => 'Digits',
                                ],
                            ],

                        ],
                ],
        ],
    ],
];
