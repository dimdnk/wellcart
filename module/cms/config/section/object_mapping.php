<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'WellCart\CMS\Entity\Page'     =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\CMS\Repository\Pages',
            'table'           => 'cms_pages',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'page_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToMany'       => [
                'translations' => [
                    'targetEntity'  => 'WellCart\CMS\Entity\PageI18n',
                    'mappedBy'      => 'page',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                    'fetch'         => "EAGER",
                ],
            ],
            'fields'          =>
                [
                    'urlKey'    =>
                        [
                            'column'                     => 'url_key',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
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
                                            'entity_class' => 'WellCart\CMS\Entity\Page',
                                            'fields'       => ['urlKey'],
                                            'messages'     => [
                                                'objectFound' => 'Url key already exists!'
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'status'    =>
                        [
                            'column'                     => 'status',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
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
                    'createdAt' =>
                        [
                            'column'   => 'created_at',
                            'type'     => 'datetime',
                            'nullable' => false,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'create',
                                        ],
                                ],
                        ],
                    'updatedAt' =>
                        [
                            'column'   => 'updated_at',
                            'type'     => 'datetime',
                            'nullable' => true,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'update',
                                        ],
                                ],
                        ],
                ],
        ],
    'WellCart\CMS\Entity\PageI18n' =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\CMS\Repository\PageI18n',
            'table'           => 'cms_page_i18n',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'translation_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToOne'        => [
                'language' => [
                    'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                    'joinColumn'   => [
                        'name'                 => 'language_id',
                        'referencedColumnName' => 'language_id'
                    ],
                ],
            ],
            'manyToOne'       => [
                'page' => [
                    'targetEntity' => 'WellCart\CMS\Entity\Page',
                    'inversedBy'   => 'translations',
                    'joinColumn'   => [
                        'name'                 => 'page_id',
                        'referencedColumnName' => 'page_id'
                    ],
                ],
            ],
            'fields'          =>
                [
                    'title'           =>
                        [
                            'column'                     => 'title',
                            'type'                       => 'string',
                            'nullable'                   => false,
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
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'body'            =>
                        [
                            'column'                     => 'body',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
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
                                                    'width'
                                                ],
                                                'a'   => [
                                                    'href'
                                                ]
                                            ]
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
                        ],
                    'metaTitle'       =>
                        [
                            'column'                     => 'meta_title',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
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
                    'metaKeywords'    =>
                        [
                            'column'                     => 'meta_keywords',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
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
                    'metaDescription' =>
                        [
                            'column'                     => 'meta_description',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
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
                    'pageId'          =>
                        [
                            'column'   => 'page_id',
                            'type'     => 'integer',
                            'nullable' => true,
                        ],
                    'createdAt'       =>
                        [
                            'column'   => 'created_at',
                            'type'     => 'datetime',
                            'nullable' => false,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'create',
                                        ],
                                ],
                        ],
                    'updatedAt'       =>
                        [
                            'column'   => 'updated_at',
                            'type'     => 'datetime',
                            'nullable' => true,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'update',
                                        ],
                                ],
                        ],
                ],
        ],
];
