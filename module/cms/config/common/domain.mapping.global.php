<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\CMS;

use WellCart\Base\Entity\Locale\Language as LanguageEntity;

return [
    'domain' => [
        'mapping' => [
            Entity\Page::class     =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\Pages::class,
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
                            'targetEntity'  => Entity\PageI18n::class,
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
                                    'column'   => 'url_key',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'status'    =>
                                [
                                    'column'   => 'status',
                                    'type'     => 'integer',
                                    'nullable' => false,
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
            Entity\PageI18n::class =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\PageI18n::class,
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
                            'targetEntity' => LanguageEntity::class,
                            'joinColumn'   => [
                                'name'                 => 'language_id',
                                'referencedColumnName' => 'language_id',
                            ],
                        ],
                    ],
                    'manyToOne'       => [
                        'page' => [
                            'targetEntity' => Entity\Page::class,
                            'inversedBy'   => 'translations',
                            'joinColumn'   => [
                                'name'                 => 'page_id',
                                'referencedColumnName' => 'page_id',
                            ],
                        ],
                    ],
                    'fields'          =>
                        [
                            'title'           =>
                                [
                                    'column'   => 'title',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'body'            =>
                                [
                                    'column'   => 'body',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'metaTitle'       =>
                                [
                                    'column'   => 'meta_title',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'metaKeywords'    =>
                                [
                                    'column'   => 'meta_keywords',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'metaDescription' =>
                                [
                                    'column'   => 'meta_description',
                                    'type'     => 'string',
                                    'nullable' => true,
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
        ],
    ],
];
