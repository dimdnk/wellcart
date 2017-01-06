<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'domain' => [
        'mapping' => [
        'WellCart\Base\Entity\Configuration'   =>
            [
                'type'            => 'entity',
                'repositoryClass' => 'WellCart\Base\Repository\Configuration',
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
                                                'entity_class' => 'WellCart\Base\Entity\Configuration',
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
        'WellCart\Base\Entity\UrlRewrite'      =>
            [
                'type'            => 'entity',
                'repositoryClass' => 'WellCart\Base\Repository\UrlRewrites',
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
                                                'entity_class' => 'WellCart\Base\Entity\UrlRewrite',
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
        'WellCart\Base\Entity\Locale\Language' =>
            [
                'type'            => 'entity',
                'entityListeners' => [
                    'WellCart\Base\EventListener\Entity\LocaleLanguageEntityListener' => [
                        'prePersist'  => ['prePersist' => 'prePersist'],
                        'preUpdate'   => ['prePersist' => 'preUpdate'],
                        'postPersist' => ['postPersist' => 'postPersist'],
                        'postUpdate'  => ['postUpdate' => 'postUpdate'],
                        'preRemove'   => ['preRemove' => 'preRemove'],
                    ],
                ],
                'repositoryClass' => 'WellCart\Base\Repository\Locale\Languages',
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
                                                'entity_class' => 'WellCart\Base\Entity\Locale\Language',
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
                                                'entity_class' => 'WellCart\Base\Entity\Locale\Language',
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
        'WellCart\Base\Entity\Queue\Job'       =>
            [
                'type'            => 'entity',
                'repositoryClass' => 'WellCart\Base\Repository\Queue\Jobs',
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
