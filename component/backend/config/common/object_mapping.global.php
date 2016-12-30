<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'object_mapping' => [
        'WellCart\Backend\Entity\Administrator' =>
            [
                'type'            => 'entity',
                'repositoryClass' => 'WellCart\Backend\Repository\Administrators',
                'table'           => 'admin_users',
                'entityListeners' => [
                    'WellCart\Backend\EventListener\Entity\AdministratorEntityListener' => [
                        'preRemove'  => ['preRemove' => 'preRemove'],
                        'preUpdate'  => ['preUpdate' => 'preUpdate'],
                        'postUpdate' => ['postUpdate' => 'postUpdate'],
                    ],
                ],
                'manyToMany'      => [
                    'roles' => [
                        'targetEntity' => 'WellCart\User\Entity\Acl\Role',
                        'inversedBy'   => 'users',
                        'joinTable'    => [
                            'name'               => 'acl_admin_user_to_role',
                            'joinColumns'        =>
                                [
                                    'user_id' =>
                                        [
                                            'referencedColumnName' => 'user_id'
                                        ]
                                ],
                            'inverseJoinColumns' => [
                                'role_id' =>
                                    [
                                        'referencedColumnName' => 'role_id'
                                    ]
                            ]
                        ],
                    ]],
                'oneToOne'        => [
                    'language' => [
                        'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                        'joinColumn'   => [
                            'name'                 => 'language_id',
                            'referencedColumnName' => 'language_id',
                        ],
                    ],
                ],
                'id'              =>
                    [
                        'id' =>
                            [
                                'column'    => 'user_id',
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
                        'state'                  =>
                            [
                                'column'                     => 'state',
                                'type'                       => 'integer',
                                'nullable'                   => false,
                                'input_filter_specification' => [
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
                            ],
                        'email'                  =>
                            [
                                'column'                     => 'email',
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
                                                'entity_class' => 'WellCart\Backend\Entity\Administrator',
                                                'fields'       => ['email'],
                                                'messages'     => [
                                                    'objectFound' => 'Account with this email already exists!'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'firstName'              =>
                            [
                                'column'                     => 'first_name',
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
                        'lastName'               =>
                            [
                                'column'                     => 'last_name',
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
                        'timeZone'               =>
                            [
                                'column'                     => 'time_zone',
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
                        'password'               =>
                            [
                                'column'                     => 'password',
                                'type'                       => 'string',
                                'length'                     => 255,
                                'nullable'                   => false,
                                'input_filter_specification' => [
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
                            ],
                        'passwordResetToken'     =>
                            [
                                'column'                     => 'password_reset_token',
                                'type'                       => 'string',
                                'length'                     => 255,
                                'nullable'                   => true,
                                'input_filter_specification' => [
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
                            ],
                        'emailConfirmationToken' =>
                            [
                                'column'                     => 'email_confirmation_token',
                                'type'                       => 'string',
                                'length'                     => 255,
                                'nullable'                   => true,
                                'input_filter_specification' => [
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
                            ],
                        'failedLoginCount'       =>
                            [
                                'column'                     => 'failed_login_count',
                                'type'                       => 'integer',
                                'nullable'                   => false,
                                'input_filter_specification' => [
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
                        'createdAt'              =>
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
                        'updatedAt'              =>
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

        'WellCart\Backend\Entity\Notification' =>
            [
                'type'            => 'entity',
                'repositoryClass' => 'WellCart\Backend\Repository\Notifications',
                'table'           => 'admin_notifications',
                'entityListeners' => [
                    'WellCart\Backend\EventListener\Entity\NotificationEntityListener' => [
                        'preRemove' => ['preRemove' => 'preRemove'],
                    ],
                ],
                'gedmo'           => [
                    'soft_deleteable' => [
                        'field_name' => 'deletedAt',
                        'time_aware' => false,
                    ]
                ],
                'id'              =>
                    [
                        'id' =>
                            [
                                'column'    => 'notification_id',
                                'type'      => 'integer',
                                'nullable'  => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'fields'          => [
                    'icon'      =>
                        [
                            'column'                     => 'icon',
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
                                            'max'      => 100,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'title'     =>
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
                    'body'      =>
                        [
                            'column'                     => 'body',
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
                                            'max'      => 512,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'isRead'    =>
                        [
                            'column'                     => 'is_read',
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
                    'isDeleted' =>
                        [
                            'column'                     => 'is_deleted',
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
                    'deletedAt' =>
                        [
                            'column'   => 'deleted_at',
                            'type'     => 'datetime',
                            'nullable' => true,
                        ],
                ],
            ],

        'WellCart\User\Entity\Acl\Role' =>
            [
                'type'            => 'entity',
                'entityListeners' => [
                    'WellCart\Backend\EventListener\Entity\RoleEntityListener' => [
                        'preUpdate' => ['preUpdate' => 'preUpdate'],
                        'preRemove' => ['preRemove' => 'preRemove'],
                    ],
                ],
            ],
    ],
];
