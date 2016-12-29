<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'object_mapping' => [
        'WellCart\User\AbstractUser' =>
            [
                'type' => 'mappedSuperclass',
                'oneToOne' => [
                    'language' => [
                        'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                        'joinColumn' => [
                            'name' => 'language_id',
                            'referencedColumnName' => 'language_id',
                        ],
                    ],
                ],
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'user_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'fields' =>
                    [
                        'state' =>
                            [
                                'column' => 'state',
                                'type' => 'integer',
                                'nullable' => false,
                            ],
                        'email' =>
                            [
                                'column' => 'email',
                                'type' => 'string',
                                'nullable' => false,
                            ],
                        'firstName' =>
                            [
                                'column' => 'first_name',
                                'type' => 'string',
                                'nullable' => false,
                            ],
                        'lastName' =>
                            [
                                'column' => 'last_name',
                                'type' => 'string',
                                'nullable' => false,
                            ],
                        'timeZone' =>
                            [
                                'column' => 'time_zone',
                                'type' => 'string',
                                'nullable' => false,
                            ],
                        'password' =>
                            [
                                'column' => 'password',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => false,
                            ],
                        'passwordResetToken' =>
                            [
                                'column' => 'password_reset_token',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => true,
                            ],
                        'emailConfirmationToken' =>
                            [
                                'column' => 'email_confirmation_token',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => true,
                            ],
                        'failedLoginCount' =>
                            [
                                'column' => 'failed_login_count',
                                'type' => 'integer',
                                'nullable' => false,
                            ],
                        'createdAt' =>
                            [
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'update',
                                            ],
                                    ],
                            ],
                    ],
            ],
        'WellCart\User\Entity\User' =>
            [
                'type' => 'entity',
                'repositoryClass' => 'WellCart\User\Repository\Users',
                'table' => 'users',
                'entityListeners' => [
                    'WellCart\User\EventListener\Entity\UserEntityListener' => [
                        'preRemove' => ['preRemove' => 'preRemove'],
                        'preUpdate' => ['preUpdate' => 'preUpdate'],
                    ],
                ],
                'manyToMany' => [
                    'roles' => [
                        'targetEntity' => 'WellCart\User\Entity\Acl\Role',
                        'inversedBy' => 'users',
                        'joinTable' => [
                            'name' => 'acl_user_to_role',
                            'joinColumns' =>
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
                'oneToOne' => [
                    'language' => [
                        'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                        'joinColumn' => [
                            'name' => 'language_id',
                            'referencedColumnName' => 'language_id',
                        ],
                    ],
                ],
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'user_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'fields' =>
                    [
                        'state' =>
                            [
                                'column' => 'state',
                                'type' => 'integer',
                                'nullable' => false,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'Digits' => [
                                            'name' => 'Digits',
                                        ],
                                        'Between' => [
                                            'name' => 'Between',
                                            'options' => [
                                                'min' => 0,
                                                'max' => PHP_INT_MAX,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'email' =>
                            [
                                'column' => 'email',
                                'type' => 'string',
                                'nullable' => false,
                                'input_filter_specification' => [
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
                                        'EmailAddress' => [
                                            'name' => 'EmailAddress',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 4,
                                                'max' => 255,
                                            ],
                                        ],
                                        'NoObjectExists' => [
                                            'name' => 'WellCart\ORM\Validator\NoObjectExists',
                                            'options' => [
                                                'entity_class' => 'WellCart\User\Entity\User',
                                                'fields' => ['email'],
                                                'messages' => [
                                                    'objectFound' => 'Email already exists!'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'firstName' =>
                            [
                                'column' => 'first_name',
                                'type' => 'string',
                                'nullable' => false,
                                'input_filter_specification' => [
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
                        'lastName' =>
                            [
                                'column' => 'last_name',
                                'type' => 'string',
                                'nullable' => false,
                                'input_filter_specification' => [
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
                        'timeZone' =>
                            [
                                'column' => 'time_zone',
                                'type' => 'string',
                                'nullable' => false,
                                'input_filter_specification' => [
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
                        'password' =>
                            [
                                'column' => 'password',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => false,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 6,
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'passwordResetToken' =>
                            [
                                'column' => 'password_reset_token',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 6,
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'emailConfirmationToken' =>
                            [
                                'column' => 'email_confirmation_token',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 6,
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'failedLoginCount' =>
                            [
                                'column' => 'failed_login_count',
                                'type' => 'integer',
                                'nullable' => false,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StringTrim' => ['name' => 'StringTrim'],
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
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'update',
                                            ],
                                    ],
                            ],
                    ],
            ],
        'WellCart\User\Entity\Acl\Permission' =>
            [
                'type' => 'entity',
                'repositoryClass' => 'WellCart\User\Repository\Acl\Permissions',
                'table' => 'acl_permissions',
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'permission_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'manyToMany' => [
                    'roles' => [
                        'targetEntity' => 'WellCart\User\Entity\Acl\Role',
                        'mappedBy' => 'permissions',
                        'cascade' => ['persist', 'merge', 'detach'],
                    ],
                ],
                'fields' =>
                    [
                        'name' =>
                            [
                                'column' => 'name',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => false,
                                'input_filter_specification' => [
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
                        'description' =>
                            [
                                'column' => 'description',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => false,
                                'input_filter_specification' => [
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
                        'isSystem' =>
                            [
                                'column' => 'is_system',
                                'type' => 'boolean',
                                'length' => 255,
                                'nullable' => false,
                                'input_filter_specification' => [
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
                        'createdAt' =>
                            [
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'update',
                                            ],
                                    ],
                            ],
                    ],
            ],
        'WellCart\User\Entity\Acl\Role' =>
            [
                'type' => 'entity',
                'entityListeners' => [
                    'WellCart\User\EventListener\Entity\RoleEntityListener' => [
                        'postPersist' => ['postPersist' => 'postPersist'],
                        'postUpdate' => ['postUpdate' => 'postUpdate'],
                        'preRemove' => ['preRemove' => 'preRemove'],
                    ],
                ],
                'repositoryClass' => 'WellCart\User\Repository\Acl\Roles',
                'manyToMany' => [
                    'permissions' => [
                        'targetEntity' => 'WellCart\User\Entity\Acl\Permission',
                        'indexBy' => 'name',
                        'fetch' => 'EAGER',
                        'inversedBy' => 'roles',
                        'cascade' => ['persist'],
                        'joinTable' => [
                            'name' => 'acl_roles_permissions',
                            'joinColumns' =>
                                [
                                    'role_id' =>
                                        [
                                            'referencedColumnName' => 'role_id'
                                        ]
                                ],
                            'inverseJoinColumns' => [
                                'permission_id' =>
                                    [
                                        'referencedColumnName' => 'permission_id'
                                    ]
                            ]
                        ],
                    ],

                    'users' => [
                        'targetEntity' => 'WellCart\User\Entity\User',
                        'mappedBy' => 'roles',
                        'cascade' => ['persist', 'merge', 'detach'],
                    ],
                ],
                'manyToOne' => [
                    'parent' => [
                        'targetEntity' => 'WellCart\User\Entity\Acl\Role',
                        'inversedBy' => 'children',
                        'joinColumn' => [
                            'name' => 'parent_id',
                            'referencedColumnName' => 'role_id',
                        ],
                    ],
                ],
                'oneToMany' => [
                    'children' => [
                        'targetEntity' => 'WellCart\User\Entity\Acl\Role',
                        'mappedBy' => 'parent',
                        'cascade' => ['persist', 'merge', 'detach'],
                    ]
                ],
                'table' => 'acl_roles',
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'role_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'fields' =>
                    [
                        'name' =>
                            [
                                'column' => 'name',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => false,
                                'input_filter_specification' => [
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
                                        'NoObjectExists' => [
                                            'name' => 'WellCart\ORM\Validator\NoObjectExists',
                                            'options' => [
                                                'entity_class' => 'WellCart\User\Entity\Acl\Role',
                                                'fields' => ['name'],
                                                'messages' => [
                                                    'objectFound' => 'Role already exists!'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'description' =>
                            [
                                'column' => 'description',
                                'type' => 'string',
                                'length' => 255,
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
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
                        'isDefault' =>
                            [
                                'column' => 'is_default',
                                'type' => 'boolean',
                                'length' => 255,
                                'nullable' => false,
                                'input_filter_specification' => [
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
                            ],
                        'isSystem' =>
                            [
                                'column' => 'is_system',
                                'type' => 'boolean',
                                'length' => 255,
                                'nullable' => true,
                                'input_filter_specification' => [
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
                            ],
                        'createdAt' =>
                            [
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
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
];
