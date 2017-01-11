<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Directory;

return [
    'domain' => [
        'input_filter' => [
            Entity\Country::class =>
                [
                    'name' =>
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
                                        'max' => 255,
                                    ],
                                ],
                            ],
                        ],
                    'status' =>
                        [
                            'required' => false,
                            'filters' => [
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                            ],
                            'validators' => [
                                'Digits' => [
                                    'name' => 'Digits',
                                ],
                                'Between' => [
                                    'name' => 'Between',
                                    'options' => [
                                        'min' => 0,
                                        'max' => 1,
                                    ],
                                ],
                            ],

                        ],
                    'postcodeRequired' =>
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
                    'addressFormat' =>
                        [
                            'required' => false,
                            'filters' => [
                                'StripTags' => ['name' => 'StripTags'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'StringLength' => [
                                    'name' => 'StringLength',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                        'max' => 255,
                                    ],
                                ],
                            ],
                        ],
                    'isoCode2' =>
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
                                        'min' => 2,
                                        'max' => 2,
                                    ],
                                ],
                            ],
                        ],
                    'isoCode3' =>
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
                                        'min' => 3,
                                        'max' => 3,
                                    ],
                                ],
                            ],
                        ],
                ],
            Entity\Currency::class =>
                [
                    'title' =>
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
                                        'max' => 255,
                                    ],
                                ],
                            ],
                        ],
                    'code' =>
                        [
                            'required' => true,
                            'filters' => [
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'StringToUpper' => ['name' => 'StringToUpper',
                                    'options' => [
                                        'encoding' => 'UTF-8',
                                    ],],
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
                                        'min' => 3,
                                        'max' => 3,
                                    ],
                                ],
                                'CurrencyCode' => ['name' => 'NetglueMoney\Validator\CurrencyCode'],
                                'NoObjectExists' => [
                                    'name' => 'WellCart\ORM\Validator\NoObjectExists',
                                    'options' => [
                                        'entity_class' => Entity\Currency::class,
                                        'fields' => ['code'],
                                        'messages' => [
                                            'objectFound' => 'Currency with this code already exists!'
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'symbol' =>
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
                                        'max' => 3,
                                    ],
                                ],

                            ],
                        ],
                    'symbolPosition' =>
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
                                        'max' => 5,
                                    ],
                                ],
                                'InArray' => [
                                    'name' => 'InArray',
                                    'options' => [
                                        'haystack' => [
                                            'left',
                                            'right'
                                        ],
                                    ],

                                ],
                            ],
                        ],
                    'exchangeRate' =>
                        [
                            'required' => true,
                            'filters' => [
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'Zend\I18n\Validator\IsFloat' => [
                                    'name' => 'Zend\I18n\Validator\IsFloat',
                                ],
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                            ],

                        ],
                    'decimals' =>
                        [
                            'required' => true,
                            'filters' => [
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'Digits' => [
                                    'name' => 'Digits',
                                ],
                                'Between' => [
                                    'name' => 'Between',
                                    'options' => [
                                        'min' => 0,
                                        'max' => 4,
                                    ],
                                ],
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                            ],

                        ],
                    'decimalsSeparator' =>
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
                                        'max' => 1,
                                    ],
                                ],

                            ],
                        ],
                    'thousandsSeparator' =>
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
                                        'max' => 1,
                                    ],
                                ],
                            ],

                        ],
                    'status' =>
                        [
                            'required' => false,
                            'filters' => [
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                            ],
                            'validators' => [
                                'Digits' => [
                                    'name' => 'Digits',
                                ],
                                'NotEmpty' => [
                                    'name' => 'NotEmpty',
                                ],
                            ],
                        ],
                    'isPrimary' =>
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
                ],
            Entity\GeoZone::class =>
                [
                    'name' =>
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
                                        'max' => 255,
                                    ],
                                ],
                            ],
                        ],
                    'description' =>
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
                                        'max' => 255,
                                    ],
                                ],
                            ],
                        ],
                ],
            Entity\GeoZoneMap::class =>
                [
                ],
            Entity\Zone::class =>
                [
                    'name' =>
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
                                        'max' => 255,
                                    ],
                                ],
                            ],

                        ],
                    'code' =>
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
                                        'max' => 32,
                                    ],
                                ],
                            ],

                        ],
                    'status' =>
                        [
                            'required' => false,
                            'filters' => [
                                'StripTags' => ['name' => 'StripTags'],
                                'StringTrim' => ['name' => 'StringTrim'],
                                'StripNewlines' => ['name' => 'StripNewlines'],
                                'Null' => ['name' => 'Null'],
                            ],
                            'validators' => [
                                'Digits' => [
                                    'name' => 'Digits',
                                ],
                                'InArray' => [
                                    'name' => 'InArray',
                                    'options' => [
                                        'haystack' => [0, 1],
                                    ],
                                ],
                            ],

                        ],
                ]
        ]
    ]
];
