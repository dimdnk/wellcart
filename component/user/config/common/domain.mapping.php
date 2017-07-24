<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User;

use WellCart\Base\Entity\Locale\Language as LanguageEntity;

return [
    'domain' => [
        'mapping' => [
            AbstractUser::class          =>
                [
                    'type'     => 'mappedSuperclass',
                    'oneToOne' => [
                        'language' => [
                            'targetEntity' => LanguageEntity::class,
                            'joinColumn'   => [
                                'name'                 => 'language_id',
                                'referencedColumnName' => 'language_id',
                            ],
                        ],
                    ],
                    'id'       =>
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
                    'fields'   =>
                        [
                            'state'                  =>
                                [
                                    'column'   => 'state',
                                    'type'     => 'integer',
                                    'nullable' => false,
                                ],
                            'email'                  =>
                                [
                                    'column'   => 'email',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'firstName'              =>
                                [
                                    'column'   => 'first_name',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'lastName'               =>
                                [
                                    'column'   => 'last_name',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'timeZone'               =>
                                [
                                    'column'   => 'time_zone',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'password'               =>
                                [
                                    'column'   => 'password',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'passwordResetToken'     =>
                                [
                                    'column'   => 'password_reset_token',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => true,
                                ],
                            'emailConfirmationToken' =>
                                [
                                    'column'   => 'email_confirmation_token',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => true,
                                ],
                            'failedLoginCount'       =>
                                [
                                    'column'   => 'failed_login_count',
                                    'type'     => 'integer',
                                    'nullable' => false,
                                ],
                            'createdAt'              =>
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
                            'updatedAt'              =>
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
            Entity\User::class           =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\Users::class,
                    'table'           => 'users',
                    'entityListeners' => [
                        EventListener\Entity\UserEntityListener::class => [
                            'preRemove' => ['preRemove' => 'preRemove'],
                            'preUpdate' => ['preUpdate' => 'preUpdate'],
                        ],
                    ],
                    'manyToMany'      => [
                        'roles' => [
                            'targetEntity' => Entity\Acl\Role::class,
                            'inversedBy'   => 'users',
                            'joinTable'    => [
                                'name'               => 'acl_user_to_role',
                                'joinColumns'        =>
                                    [
                                        'user_id' =>
                                            [
                                                'referencedColumnName' => 'user_id',
                                            ],
                                    ],
                                'inverseJoinColumns' => [
                                    'role_id' =>
                                        [
                                            'referencedColumnName' => 'role_id',
                                        ],
                                ],
                            ],
                        ]],
                    'oneToOne'        => [
                        'language' => [
                            'targetEntity' => LanguageEntity::class,
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
                                    'column'   => 'state',
                                    'type'     => 'integer',
                                    'nullable' => false,
                                ],
                            'email'                  =>
                                [
                                    'column'   => 'email',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'firstName'              =>
                                [
                                    'column'   => 'first_name',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'lastName'               =>
                                [
                                    'column'   => 'last_name',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'timeZone'               =>
                                [
                                    'column'   => 'time_zone',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'password'               =>
                                [
                                    'column'   => 'password',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'passwordResetToken'     =>
                                [
                                    'column'   => 'password_reset_token',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => true,
                                ],
                            'emailConfirmationToken' =>
                                [
                                    'column'   => 'email_confirmation_token',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => true,
                                ],
                            'failedLoginCount'       =>
                                [
                                    'column'   => 'failed_login_count',
                                    'type'     => 'integer',
                                    'nullable' => false,
                                ],
                            'createdAt'              =>
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
                            'updatedAt'              =>
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
            Entity\Acl\Permission::class =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\Acl\Permissions::class,
                    'table'           => 'acl_permissions',
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'permission_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToMany'      => [
                        'roles' => [
                            'targetEntity' => Entity\Acl\Role::class,
                            'mappedBy'     => 'permissions',
                            'cascade'      => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'fields'          =>
                        [
                            'name'        =>
                                [
                                    'column'   => 'name',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'description' =>
                                [
                                    'column'   => 'description',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'isSystem'    =>
                                [
                                    'column'   => 'is_system',
                                    'type'     => 'boolean',
                                    'length'   => 255,
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
            Entity\Acl\Role::class       =>
                [
                    'type'            => 'entity',
                    'entityListeners' => [
                        EventListener\Entity\RoleEntityListener::class => [
                            'postPersist' => ['postPersist' => 'postPersist'],
                            'postUpdate'  => ['postUpdate' => 'postUpdate'],
                            'preRemove'   => ['preRemove' => 'preRemove'],
                        ],
                    ],
                    'repositoryClass' => Repository\Acl\Roles::class,
                    'manyToMany'      => [
                        'permissions' => [
                            'targetEntity' => Entity\Acl\Permission::class,
                            'indexBy'      => 'name',
                            'fetch'        => 'EAGER',
                            'inversedBy'   => 'roles',
                            'cascade'      => ['persist'],
                            'joinTable'    => [
                                'name'               => 'acl_roles_permissions',
                                'joinColumns'        =>
                                    [
                                        'role_id' =>
                                            [
                                                'referencedColumnName' => 'role_id',
                                            ],
                                    ],
                                'inverseJoinColumns' => [
                                    'permission_id' =>
                                        [
                                            'referencedColumnName' => 'permission_id',
                                        ],
                                ],
                            ],
                        ],

                        'users' => [
                            'targetEntity' => Entity\User::class,
                            'mappedBy'     => 'roles',
                            'cascade'      => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'manyToOne'       => [
                        'parent' => [
                            'targetEntity' => Entity\Acl\Role::class,
                            'inversedBy'   => 'children',
                            'joinColumn'   => [
                                'name'                 => 'parent_id',
                                'referencedColumnName' => 'role_id',
                            ],
                        ],
                    ],
                    'oneToMany'       => [
                        'children' => [
                            'targetEntity' => Entity\Acl\Role::class,
                            'mappedBy'     => 'parent',
                            'cascade'      => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'table'           => 'acl_roles',
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'role_id',
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
                            'name'        =>
                                [
                                    'column'   => 'name',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'description' =>
                                [
                                    'column'   => 'description',
                                    'type'     => 'string',
                                    'length'   => 255,
                                    'nullable' => true,
                                ],
                            'isDefault'   =>
                                [
                                    'column'   => 'is_default',
                                    'type'     => 'boolean',
                                    'length'   => 255,
                                    'nullable' => false,
                                ],
                            'isSystem'    =>
                                [
                                    'column'   => 'is_system',
                                    'type'     => 'boolean',
                                    'length'   => 255,
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
        ],
    ],
];
