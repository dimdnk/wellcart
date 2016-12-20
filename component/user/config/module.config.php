<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User;

return [
    'wellcart'        => [
        'user_account_options' => [
            'max_login_attempts' => 5,
            'password_reset'     => [
                'email_contact'          => 'support',
                'email_template'         => 'wellcart-user/password_reset',
                'link_expiration_period' => 1,
                'allow_for_admin'        => true,
            ],
            'registration'       => [
                'send_welcome_email' => true,
                'confirm_email'      => true,
                'email_contact'      => 'general',
                'email_template'     => [
                    'welcome'            => 'wellcart-user/welcome',
                    'email_confirmation' => 'wellcart-user/email_confirmation',
                    'email_confirmed'    => 'wellcart-user/email_confirmed',
                ],
            ],
        ],
    ],

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
            'ZfcRbac\Collector\RbacCollector'              => 'WellCart\User\DeveloperTools\Rbac\Collector\RbacCollector',
            'WellCart\User\PageView\Admin\PreferencesForm' => 'WellCart\User\PageView\Admin\PreferencesForm',
            'WellCart\User\Form\RecoverAccount'            => 'WellCart\User\Form\RecoverAccount',

            'WellCart\User\EventListener\Registration\AddRequiredFieldsToFilter'  => 'WellCart\User\EventListener\Registration\AddRequiredFieldsToFilter',
            'WellCart\User\EventListener\Registration\AddRequiredFieldsToForm'    => 'WellCart\User\EventListener\Registration\AddRequiredFieldsToForm',
            'WellCart\User\EventListener\Registration\BindRequiredFieldsToEntity' => 'WellCart\User\EventListener\Registration\BindRequiredFieldsToEntity',
            'WellCart\User\EventListener\UnauthorizedStrategy'                    => 'WellCart\User\EventListener\UnauthorizedStrategy',

        ],
        'factories'          => [
            'WellCart\User\Command\Handler\PersistUserAccountHandler'            => 'WellCart\User\Factory\Command\Handler\PersistUserAccountHandlerFactory',
            'WellCart\User\EventListener\Login\EmailNotConfirmed'                => 'WellCart\User\Factory\EventListener\Login\EmailNotConfirmedFactory',
            'WellCart\User\EventListener\Login\HandleFailedLoginCount'           => 'WellCart\User\Factory\EventListener\Login\HandleFailedLoginCountFactory',
            'WellCart\User\EventListener\Login\IdentityReview'                   => 'WellCart\User\Factory\EventListener\Login\IdentityReviewFactory',
            'WellCart\User\EventListener\Registration\SetDefaultAccountSettings' => 'WellCart\User\Factory\EventListener\Registration\SetDefaultAccountSettingsFactory',
            'WellCart\User\EventListener\UserEntityListener'                     => 'WellCart\User\Factory\EventListener\UserEntityListenerFactory',
            'zfcuser_user_service'                                               => 'WellCart\User\Factory\Service\UserFactory',
        ],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            'WellCart\User\PageView\Admin\AccountsGrid'    => false,
            'WellCart\User\PageView\Admin\AccountForm'     => false,
            'WellCart\User\PageView\Admin\RolesGrid'       => false,
            'WellCart\User\PageView\Admin\RoleForm'        => false,
            'WellCart\User\PageView\Admin\PreferencesForm' => false,
        ],
    ],

    'form_elements' => [
        'factories' => [
            'userRolesMultiCheckboxSelector'       => Factory\FormElement\RolesMultiCheckboxSelectorFactory::class,
            'userPermissionsMultiCheckboxSelector' => Factory\FormElement\PermissionsMultiCheckboxSelectorFactory::class,
            'userAccountsSelector'                 => Factory\FormElement\AccountsSelectorFactory::class,
        ],
    ],

    'event_manager' => include __DIR__ . '/section/event_manager.php',
    'listeners'     => [
        'WellCart\User\EventListener\UnauthorizedStrategy' => 'WellCart\User\EventListener\UnauthorizedStrategy',
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
                                'controller' => 'User::Admin\Accounts',
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
                                        'controller' => 'User::Admin\Accounts',
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
                                        'controller' => 'User::Admin\Acl\Roles',
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
                                        'controller' => 'User::Admin\Preferences',
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
            'User::Admin\Accounts'    => Controller\Admin\AccountsController::class,
            'User::Admin\Acl\Roles'   => Controller\Admin\Acl\RolesController::class,
            'User::Admin\Preferences' => Controller\Admin\PreferencesController::class,
        ],
        'factories' => [
            'zfcuser'                                     => Factory\Controller\UserControllerFactory::class,
            Controller\ConfirmEmailController::class      => Factory\Controller\ConfirmEmailControllerFactory::class,
            Controller\RecoverAccountController::class    => Factory\Controller\RecoverAccountControllerFactory::class,
            Controller\Admin\AccountsController::class    => Factory\Controller\Admin\AccountsControllerFactory::class,
            Controller\Admin\Acl\RolesController::class   => Factory\Controller\Admin\Acl\RolesControllerFactory::class,
            Controller\Admin\PreferencesController::class => Factory\Controller\Admin\PreferencesControllerFactory::class,
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
                'identity_class'      => 'WellCart\User\Entity\User',
                'identity_property'   => 'email',
                'credential_property' => 'password',
            ],
        ],
        'driver'          => [
            'wellcart_user_xml_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/mapping/'
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
    'zfcuser'     => include __DIR__ . '/section/zfcuser.php',
    'zfc_rbac'    => include __DIR__ . '/section/zfc_rbac.php',


    'system_config_editor' => include __DIR__
        . '/section/system_config_editor.php',
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

    /**
     * =========================================================
     * View manager configuration
     * =========================================================
     */
    'view_manager'          => [
        'template_map' => include __DIR__ . '/section/template_map.php',

    ],

    /**
     * =========================================================
     * Object mapping configuration
     * =========================================================
     */
    'object_mapping'        => include __DIR__ . '/section/object_mapping.php',
    'context_specific'      => [
        'frontend' => [
            'wellcart' => [
                'user_account_options' => [
                    'registration' => [
                        'send_welcome_email' => true,
                        'confirm_email'      => true,
                    ]
                ],
            ],
            'zfcuser'  => [
                'enable_registration' => true,
            ],
        ],
    ],

    'command_bus' => [
        'command_map' => [
            Command\PersistUserAccount::class => Command\Handler\PersistUserAccountHandler::class,
        ],
    ],
];
