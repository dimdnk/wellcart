<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Backend;

use WellCart\Base\Entity\Locale\Language as LanguageEntity;

return [
    'domain' => [
        'mapping' => [
            Entity\Administrator::class =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\Administrators::class,
                    'table'           => 'admin_users',
                    'entityListeners' => [
                        EventListener\Entity\AdministratorEntityListener::class => [
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

            Entity\Notification::class =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\Notifications::class,
                    'table'           => 'admin_notifications',
                    'entityListeners' => [
                        EventListener\Entity\NotificationEntityListener::class => [
                            'preRemove' => ['preRemove' => 'preRemove'],
                        ],
                    ],
                    'gedmo'           => [
                        'soft_deleteable' => [
                            'field_name' => 'deletedAt',
                            'time_aware' => false,
                        ],
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
                                'column'   => 'icon',
                                'type'     => 'string',
                                'nullable' => false,
                            ],
                        'title'     =>
                            [
                                'column'   => 'title',
                                'type'     => 'string',
                                'nullable' => false,
                            ],
                        'body'      =>
                            [
                                'column'   => 'body',
                                'type'     => 'string',
                                'nullable' => false,
                            ],
                        'isRead'    =>
                            [
                                'column'   => 'is_read',
                                'type'     => 'boolean',
                                'nullable' => false,
                            ],
                        'isDeleted' =>
                            [
                                'column'   => 'is_deleted',
                                'type'     => 'boolean',
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
                        'deletedAt' =>
                            [
                                'column'   => 'deleted_at',
                                'type'     => 'timestamp',
                                'nullable' => true,
                            ],
                    ],
                ],

            'WellCart\User\Entity\Acl\Role' =>
                [
                    'type'            => 'entity',
                    'entityListeners' => [
                        EventListener\Entity\RoleEntityListener::class => [
                            'preUpdate' => ['preUpdate' => 'preUpdate'],
                            'preRemove' => ['preRemove' => 'preRemove'],
                        ],
                    ],
                ],
        ],
    ],
];
