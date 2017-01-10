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
                                'column'                     => 'config_key',
                                'type'                       => 'string',
                                'length'                     => 255,
                                'nullable'                   => false,
                                'input_filter_specification' => [
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
                                                    'objectFound' => 'Config key already exists!'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'configValue' =>
                            [
                                'column'                     => 'config_value',
                                'type'                       => 'string',
                                'length'                     => 255,
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
                        'context'     =>
                            [
                                'column'                     => 'context',
                                'type'                       => 'string',
                                'length'                     => 15,
                                'nullable'                   => true,
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
                                                'max'      => 15,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'environment' =>
                            [
                                'column'                     => 'environment',
                                'type'                       => 'string',
                                'length'                     => 15,
                                'nullable'                   => true,
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
                                                'max'      => 15,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'createdAt'   =>
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
                        'updatedAt'   =>
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
                                'column'                     => 'request_path',
                                'type'                       => 'string',
                                'length'                     => 255,
                                'nullable'                   => false,
                                'input_filter_specification' => [
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
                                                    'objectFound' => 'Request path already exists!'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'targetPath'  =>
                            [
                                'column'                     => 'target_path',
                                'type'                       => 'string',
                                'length'                     => 255,
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
                        'isSystem'    =>
                            [
                                'column'                     => 'is_system',
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
                        'createdAt'   =>
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
                        'updatedAt'   =>
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
                                'column'                     => 'name',
                                'type'                       => 'string',
                                'length'                     => 255,
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
                                                    'objectFound' => 'Language already exists!'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'code'      =>
                            [
                                'column'                     => 'code',
                                'type'                       => 'string',
                                'length'                     => 255,
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
                                                    'objectFound' => 'Language code already exists!'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'locale'    =>
                            [
                                'column'                     => 'locale',
                                'type'                       => 'string',
                                'length'                     => 255,
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
                                                'min'      => 2,
                                                'max'      => 6,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'territory' =>
                            [
                                'column'                     => 'territory',
                                'type'                       => 'string',
                                'length'                     => 255,
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
                                                'max'      => 3,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'isSystem'  =>
                            [
                                'column'                     => 'is_system',
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
                        'isActive'  =>
                            [
                                'column'                     => 'is_active',
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
                        'sortOrder' =>
                            [
                                'column'                     => 'sort_order',
                                'type'                       => 'integer',
                                'nullable'                   => false,
                                'input_filter_specification' => [
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
        Entity\Queue\Job::class       =>
            [
                'type'            => 'entity',
                'repositoryClass' => Repository\Queue\Jobs::class,
                'table'           => 'base_job_queue',
                'id'              =>
                    [
                        'id' =>
                            [
                                'column'    => 'id',
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
                        'queue'       =>
                            [
                                'column'                     => 'queue',
                                'type'                       => 'string',
                                'length'                     => 64,
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
                                                'max'      => 64,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'data'        =>
                            [
                                'column'                     => 'data',
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
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                        'message'     =>
                            [
                                'column'                     => 'message',
                                'type'                       => 'string',
                                'nullable'                   => false,
                                'input_filter_specification' => [
                                    'required'   => false,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [],
                                ],
                            ],
                        'trace'       =>
                            [
                                'column'                     => 'trace',
                                'type'                       => 'string',
                                'nullable'                   => false,
                                'input_filter_specification' => [
                                    'required'   => false,
                                    'filters'    => [
                                        'StripTags'     => ['name' => 'StripTags'],
                                        'StringTrim'    => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null'          => ['name' => 'Null'],
                                    ],
                                    'validators' => [],
                                ],
                            ],
                        'status'      =>
                            [
                                'column'                     => 'status',
                                'type'                       => 'integer',
                                'nullable'                   => false,
                                'input_filter_specification' => [
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
                        'createdAt'   =>
                            [
                                'column'   => 'created',
                                'type'     => 'datetime',
                                'nullable' => false,
                            ],
                        'scheduledAt' =>
                            [
                                'column'   => 'scheduled',
                                'type'     => 'datetime',
                                'nullable' => false,
                            ],
                        'executedAt'  =>
                            [
                                'column'   => 'executed',
                                'type'     => 'datetime',
                                'nullable' => true,
                            ],
                        'finishedAt'  =>
                            [
                                'column'   => 'finished',
                                'type'     => 'datetime',
                                'nullable' => true,
                            ],
                    ],
            ],
    ],
    ],
];
