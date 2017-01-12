<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\CMS;

return [
    'domain' => [
        'input_filter' => [
            Entity\Page::class     =>
                [
                    'urlKey' =>
                        [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => ['name' => 'StripTags'],
                                'StringTrim'    => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null'          => ['name' => 'Null'],
                                ['name' => 'StringToLower'],
                                ['name' => 'WellCart\Filter\Slugify'],
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
                                        'entity_class' => Entity\Page::class,
                                        'fields'       => ['urlKey'],
                                        'messages'     => [
                                            'objectFound' => 'Url key already exists!',
                                        ],
                                    ],
                                ],

                            ],
                        ],
                    'status' =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StringTrim' => ['name' => 'StringTrim'],
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
                                        'max' => 1,
                                    ],
                                ],
                            ],
                        ],


                ],
            Entity\PageI18n::class =>
                [
                    'title'           =>
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
                    'body'            =>
                        [
                            'required'   => true,
                            'filters'    => [
                                'StripTags'     => [
                                    'name'    => 'StripTags',
                                    'options' => [
                                        'allowTags' => [
                                            'h1', 'h2',
                                            'h3', 'h4', 'h5',
                                            'h6', 'blockquote',
                                            'cite', 'article', 'aside',
                                            'code', 'em', 'i', 'b',
                                            'strong', 'dfn',
                                            'footer', 'header',
                                            'p', 'ol', 'ul', 'li',
                                            'dl', 'dt', 'hgroup',
                                            'img' => [
                                                'src',
                                                'width',
                                            ],
                                            'a'   => [
                                                'href',
                                            ],
                                        ],
                                    ],
                                ],
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
                                        'max'      => 21845,
                                    ],
                                ],
                            ],
                        ],
                    'metaTitle'       =>
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
                    'metaKeywords'    =>
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
                    'metaDescription' =>
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
                ],
        ],
    ],
];
