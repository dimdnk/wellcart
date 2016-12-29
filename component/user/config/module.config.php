<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User;

return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager' => [
        'aliases'            => [
            'wellcart_user_db_adapter'          => 'Zend\Db\Adapter\Adapter',
            'wellcart_user_mapper'              => 'zfcuser_user_mapper',
            'wellcart_user_object_manager'      => 'Doctrine\ORM\EntityManager',
            'wellcart_user_doctrine_hydrator'   => 'doctrine_hydrator',
            Spec\AclPermissionRepository::class => Repository\Acl\Permissions::class,
            Spec\AclRoleRepository::class       => Repository\Acl\Roles::class,
            Spec\UserRepository::class          => Repository\Users::class,
        ],
        'invokables'         => [
            'ZfcRbac\Collector\RbacCollector'              => DeveloperTools\Rbac\Collector\RbacCollector::class,
            PageView\Backend\PreferencesForm::class => PageView\Backend\PreferencesForm::class,
            Form\RecoverAccount::class            => Form\RecoverAccount::class,

            EventListener\Registration\AddRequiredFieldsToFilter::class  => EventListener\Registration\AddRequiredFieldsToFilter::class,
            EventListener\Registration\AddRequiredFieldsToForm::class    => EventListener\Registration\AddRequiredFieldsToForm::class,
            EventListener\Registration\BindRequiredFieldsToEntity::class => EventListener\Registration\BindRequiredFieldsToEntity::class,
            EventListener\UnauthorizedStrategy::class                    => EventListener\UnauthorizedStrategy::class,

        ],
        'factories'          => [
            Command\Handler\PersistUserAccountHandler::class            => Factory\Command\Handler\PersistUserAccountHandlerFactory::class,
            EventListener\Login\EmailNotConfirmed::class                => Factory\EventListener\Login\EmailNotConfirmedFactory::class,
            EventListener\Login\HandleFailedLoginCount::class           => Factory\EventListener\Login\HandleFailedLoginCountFactory::class,
            EventListener\Login\IdentityReview::class                   => Factory\EventListener\Login\IdentityReviewFactory::class,
            EventListener\Registration\SetDefaultAccountSettings::class => Factory\EventListener\Registration\SetDefaultAccountSettingsFactory::class,
            EventListener\Entity\UserEntityListener::class              => Factory\EventListener\Entity\UserEntityListenerFactory::class,
            'zfcuser_user_service'                                               => Factory\Service\UserFactory::class,
        ],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            PageView\Backend\AccountsGrid::class    => false,
            PageView\Backend\AccountForm::class     => false,
            PageView\Backend\RolesGrid::class       => false,
            PageView\Backend\RoleForm::class        => false,
            PageView\Backend\PreferencesForm::class => false,
        ],
    ],

    'form_elements' => [
        'factories' => [
            'userRolesMultiCheckboxSelector'       => Factory\FormElement\RolesMultiCheckboxSelectorFactory::class,
            'userPermissionsMultiCheckboxSelector' => Factory\FormElement\PermissionsMultiCheckboxSelectorFactory::class,
            'userAccountsSelector'                 => Factory\FormElement\AccountsSelectorFactory::class,
        ],
    ],

    'listeners'     => [
        EventListener\UnauthorizedStrategy::class => EventListener\UnauthorizedStrategy::class,
    ],

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'        => [
        'routes' => [
            'zfcadmin'                   => [
                'child_routes' => [
                    'user' => [
                        'type'         => 'WellCart\Router\Http\Literal',
                        'priority'     => -500,
                        'options'      => [
                            'route'    => 'user/',
                            'defaults' => [
                                'controller' => 'User::Backend\Accounts',
                                'action'     => 'list',
                            ],
                        ],
                        'child_routes' => [
                            'accounts'    => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'accounts[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'User::Backend\Accounts',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'roles'       => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'roles[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'User::Backend\Acl\Roles',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'preferences' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'preferences[/]',
                                    'constraints' => [],
                                    'defaults'    => [
                                        'controller' => 'User::Backend\Preferences',
                                        'action'     => 'update',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'user-account-confirm-email' => [
                'type'             => 'WellCart\Router\Http\Segment',
                'javascript_route' => true,
                'priority'         => -500,
                'options'          => [
                    'route'    => '/account/confirm/:token',
                    'defaults' => [
                        'controller' => 'User::ConfirmEmail',
                        'action'     => 'confirm',
                        'token'      => false,
                    ],
                ],
            ],
            'user-account-recovery'      => [
                'type'             => 'WellCart\Router\Http\Literal',
                'javascript_route' => true,
                'priority'         => -500,
                'options'          => [
                    'route'    => '/account/recover',
                    'defaults' => [
                        'controller' => 'User::RecoverAccount',
                        'action'     => 'initiate',
                    ],
                ],
                'may_terminate'    => true,
                'child_routes'     => [
                    'initiate' => [
                        'type'             => 'WellCart\Router\Http\Literal',
                        'javascript_route' => true,
                        'priority'         => -500,
                        'options'          => [
                            'route'    => '/initiate',
                            'defaults' => [
                                'controller' => 'User::RecoverAccount',
                                'action'     => 'initiate',
                            ],
                        ],
                        'may_terminate'    => true,
                    ],
                    'reset'    => [
                        'type'             => 'WellCart\Router\Http\Segment',
                        'javascript_route' => true,
                        'priority'         => -500,
                        'options'          => [
                            'route'    => '/reset/:token',
                            'defaults' => [
                                'controller' => 'User::RecoverAccount',
                                'action'     => 'reset',
                                'token'      => '',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'aliases'   => [
            'User::ConfirmEmail'      => Controller\ConfirmEmailController::class,
            'User::RecoverAccount'    => Controller\RecoverAccountController::class,
            'User::Backend\Accounts'    => Controller\Backend\AccountsController::class,
            'User::Backend\Acl\Roles'   => Controller\Backend\Acl\RolesController::class,
            'User::Backend\Preferences' => Controller\Backend\PreferencesController::class,
        ],
        'factories' => [
            'zfcuser'                                     => Factory\Controller\UserControllerFactory::class,
            Controller\ConfirmEmailController::class      => Factory\Controller\ConfirmEmailControllerFactory::class,
            Controller\RecoverAccountController::class    => Factory\Controller\RecoverAccountControllerFactory::class,
            Controller\Backend\AccountsController::class    => Factory\Controller\Backend\AccountsControllerFactory::class,
            Controller\Backend\Acl\RolesController::class   => Factory\Controller\Backend\Acl\RolesControllerFactory::class,
            Controller\Backend\PreferencesController::class => Factory\Controller\Backend\PreferencesControllerFactory::class,
        ],
    ],
    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'    => [
        'eventmanager'    => [
            'orm_default' => [
                'subscribers' => [],
            ],
        ],
        'authentication'  => [
            'orm_default' => [
                'object_manager'      => 'Doctrine\ORM\EntityManager',
                'identity_class'      => Entity\User::class,
                'identity_property'   => 'email',
                'credential_property' => 'password',
            ],
        ],
        'driver'          => [
            'wellcart_user_xml_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/common/mapping/'
            ],
            'wellcart_user_driver'     => [
                'class' => 'WellCart\ORM\Mapping\Driver\SystemConfigDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ => __DIR__ . '/../src/Entity/',
                ],
            ],
            // default metadata driver, aggregates all other drivers into a single one.
            'orm_default'              => [
                'drivers' => [
                    'WellCart\User\Entity' => 'wellcart_user_driver',
                    'ZfcUser\Entity'       => 'wellcart_user_xml_driver',
                ]
            ]
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    Spec\UserEntity::class          => Entity\User::class,
                    Spec\AclPermissionEntity::class => Entity\Acl\Permission::class,
                    Spec\AclRoleEntity::class       => Entity\Acl\Role::class,
                    'User::User'                    => Entity\User::class,
                    'User::Acl\AclPermission'       => Entity\Acl\Permission::class,
                    'User::Acl\Role'                => Entity\Acl\Role::class,
                ]
            ]
        ],
    ],

    /**
     * =========================================================
     * Static assets configuration
     * =========================================================
     */
    'asset_manager'        => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ => __DIR__ . '/../public/',
            ],
        ],
    ],

    'assetic_configuration' => [
        'acceptableErrors' => [
            \ZfcRbac\Guard\GuardInterface::GUARD_UNAUTHORIZED
        ]
    ],

    /**
     * =========================================================
     * Translator configuration
     * =========================================================
     */
    'translator'            => [
        'translation_file_patterns' => [
            __FILE__ => [
                'text_domain' => 'default',
                'type'        => 'gettext',
                'base_dir'    => __DIR__ . '/../language',
                'pattern'     => '%s.mo',
            ],
        ],
    ],
    'command_bus' => [
        'command_map' => [
            Command\PersistUserAccount::class => Command\Handler\PersistUserAccountHandler::class,
        ],
    ],
];
