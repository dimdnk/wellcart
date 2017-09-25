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
        'mapping' => [
            Entity\Configuration::class   =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\Configuration::class,
                    'table'           => 'base_configuration',
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'config_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'fields'          =>
                        [
                            'configKey'   =>
                                [
                                    'column'   => 'config_key',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'configValue' =>
                                [
                                    'column'   => 'config_value',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'context'     =>
                                [
                                    'column'   => 'context',
                                    'type'     => 'string',
                                    'length'   => 15,
                                    'nullable' => true,
                                ],
                            'environment' =>
                                [
                                    'column'   => 'environment',
                                    'type'     => 'string',
                                    'length'   => 15,
                                    'nullable' => true,
                                ],
                            'createdAt'   =>
                                [
                                    'column'   => 'created_at',
                                    'type'     => 'timestamp',
                                    'nullable' => false,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'create',
                                                ],
                                        ],
                                ],
                            'updatedAt'   =>
                                [
                                    'column'   => 'updated_at',
                                    'type'     => 'timestamp',
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
            Entity\UrlRewrite::class      =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\UrlRewrites::class,
                    'table'           => 'base_url_rewrites',
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'rewrite_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'fields'          =>
                        [
                            'requestPath' =>
                                [
                                    'column'   => 'request_path',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'targetPath'  =>
                                [
                                    'column'   => 'target_path',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'isSystem'    =>
                                [
                                    'column'   => 'is_system',
                                    'type'     => 'boolean',
                                    'nullable' => false,
                                ],
                            'createdAt'   =>
                                [
                                    'column'   => 'created_at',
                                    'type'     => 'timestamp',
                                    'nullable' => false,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'create',
                                                ],
                                        ],
                                ],
                            'updatedAt'   =>
                                [
                                    'column'   => 'updated_at',
                                    'type'     => 'timestamp',
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
            Entity\Locale\Language::class =>
                [
                    'type'            => 'entity',
                    'entityListeners' => [
                        EventListener\Entity\LocaleLanguageEntityListener::class => [
                            'prePersist'  => ['prePersist' => 'prePersist'],
                            'preUpdate'   => ['prePersist' => 'preUpdate'],
                            'postPersist' => ['postPersist' => 'postPersist'],
                            'postUpdate'  => ['postUpdate' => 'postUpdate'],
                            'preRemove'   => ['preRemove' => 'preRemove'],
                        ],
                    ],
                    'repositoryClass' => Repository\Locale\Languages::class,
                    'table'           => 'base_locale_languages',
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'language_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'fields'          =>
                        [
                            'name'      =>
                                [
                                    'column'   => 'name',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'code'      =>
                                [
                                    'column'   => 'code',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'locale'    =>
                                [
                                    'column'   => 'locale',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'territory' =>
                                [
                                    'column'   => 'territory',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'isSystem'  =>
                                [
                                    'column'   => 'is_system',
                                    'type'     => 'boolean',
                                    'nullable' => false,
                                ],
                            'isDefault' =>
                                [
                                    'column'   => 'is_default',
                                    'type'     => 'boolean',
                                    'nullable' => false,
                                ],
                            'isActive'  =>
                                [
                                    'column'   => 'is_active',
                                    'type'     => 'boolean',
                                    'nullable' => false,
                                ],
                            'sortOrder' =>
                                [
                                    'column'   => 'sort_order',
                                    'type'     => 'integer',
                                    'nullable' => false,
                                ],
                            'createdAt' =>
                                [
                                    'column'   => 'created_at',
                                    'type'     => 'timestamp',
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
                                    'type'     => 'timestamp',
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
