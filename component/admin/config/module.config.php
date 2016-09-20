<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Admin;

return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager' => [
        'invokables'         => [
            ItemView\PageHead::class      => ItemView\PageHead::class,
            ItemView\PageNavigator::class => ItemView\PageNavigator::class,

            'zfcDatagrid.renderer.HtmlDataGrid'        => PageView\Grid\Renderer::class,
            EventListener\SetupPageVariables::class    => EventListener\SetupPageVariables::class,
            EventListener\RemoveConfigCacheFile::class => EventListener\RemoveConfigCacheFile::class,
            ItemView\TopBranding::class                => ItemView\TopBranding::class,
            ItemView\MainNavigationMenu::class         => ItemView\MainNavigationMenu::class,
            ItemView\Account\WelcomeBox::class         => ItemView\Account\WelcomeBox::class,

            Form\RecoverAccount::class => Form\RecoverAccount::class,

        ],
        'aliases'            => [
            'wellcart-admin_db_adapter'        => 'Zend\Db\Adapter\Adapter',
            'wellcart_admin_object_manager'    => 'Doctrine\ORM\EntityManager',
            'wellcart_admin_doctrine_hydrator' => 'doctrine_hydrator',

            Spec\AdministratorRepository::class => Repository\Administrators::class,
            Spec\NotificationRepository::class  => Repository\Notifications::class,
            'admin\notification'                => Service\Notification::class,
        ],
        'factories'          => [
            Rbac\View\Strategy\UnauthorizedStrategy::class    => Factory\Rbac\View\Strategy\UnauthorizedStrategyFactory::class,
            Command\Handler\PersistAdminAccountHandler::class => Factory\Command\Handler\PersistAdminAccountHandlerFactory::class,
            EventListener\AdministratorEntityListener::class  => Factory\EventListener\AdministratorEntityListenerFactory::class,
            'backend_main_navigation'                         => Factory\Navigation\Service\BackendMainMenuFactory::class,
        ],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            ItemView\TopBranding::class             => false,
            ItemView\MainNavigationMenu::class      => false,
            PageView\Admin\AccountsGrid::class      => false,
            PageView\Admin\AccountForm::class       => false,
            PageView\Admin\NotificationsGrid::class => false,
        ],
    ],

    /**
     * =========================================================
     * Static assets configuration
     * =========================================================
     */
    'asset_manager'   => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ => __DIR__ . '/../public/',
            ],
        ],
    ],

    /**
     * =========================================================
     * Translator configuration
     * =========================================================
     */
    'translator'      => [
        'translation_file_patterns' => [
            __FILE__ => [
                'text_domain' => 'default',
                'type'        => 'gettext',
                'base_dir'    => __DIR__ . '/../language',
                'pattern'     => '%s.mo',
            ],
        ],
    ],

    'context_specific' => include __DIR__ . '/section/context_specific.php',

    /**
     * =========================================================
     * Object mapping configuration
     * =========================================================
     */
    'object_mapping'   => include __DIR__ . '/section/object_mapping.php',
    'layout_updates'   => include __DIR__ . '/section/layout_updates.php',

    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'         => [
        'driver'          => [
            'wellcart_admin_driver' => [
                'class' => 'WellCart\ORM\Mapping\Driver\SystemConfigDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ => __DIR__ . '/../src/Entity/',
                ],
            ],
            // default metadata driver, aggregates all other drivers into a single one.
            'orm_default'           => [
                'drivers' => [
                    'WellCart\Admin\Entity' => 'wellcart_admin_driver',
                ]
            ]
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    Spec\AdministratorEntity::class => Entity\Administrator::class,
                    'Admin::Administrator'          => Entity\Administrator::class,
                    Spec\NotificationEntity::class  => Entity\Notification::class,
                    'Admin::Notification'           => Entity\Notification::class,
                ]
            ]
        ],
    ],

    'ze_theme'      => [
        'adapters' => [
            Ui\Theme\AdminRouteAdapter::class => Ui\Theme\AdminRouteAdapter::class,
        ],
    ],
    'zfcadmin'      => [
        'use_admin_layout'      => true,
        'admin_layout_template' => 'layout/page-fluid-2columns',
    ],

    /**
     * =========================================================
     * View manager configuration
     * =========================================================
     */
    'view_manager'  => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        /**
         * Template map
         */
        'template_map'        => include __DIR__ . '/section/template_map.php',
    ],
    /**
     * Default ZfcRbac configuration for RBAC
     */
    'zfc_rbac'      => [
        'guards' => [
            'ZfcRbac\Guard\RouteGuard' => [
                'zfcadmin*' => ['admin' => 'admin'],
            ]
        ],
    ],
    'event_manager' => include __DIR__ . '/section/event_manager.php',

    'controllers' => [
        'factories' => [
            'WellCart\Admin\Controller\Login'               => Factory\Controller\LoginControllerFactory::class,
            'WellCart\Admin\Controller\Logout'              => Factory\Controller\LogoutControllerFactory::class,
            'WellCart\Admin\Controller\Dashboard'           => Factory\Controller\DashboardControllerFactory::class,
            'WellCart\Admin\Controller\RecoverAccount'      => Factory\Controller\RecoverAccountControllerFactory::class,
            'WellCart\Admin\Controller\Settings'            => Factory\Controller\SettingsControllerFactory::class,
            'WellCart\Admin\Controller\Admin\Accounts'      => Factory\Controller\Admin\AccountsControllerFactory::class,
            'WellCart\Admin\Controller\Admin\Notifications' => Factory\Controller\Admin\NotificationsControllerFactory::class,
        ],
    ],

    'controller_plugins'   => [
        'aliases'   => [
            'admin_notification' => Mvc\Controller\Plugin\Notification::class,
        ],
        'factories' => [
            Mvc\Controller\Plugin\Notification::class => Factory\ControllerPlugin\NotificationPluginFactory::class,
        ],
    ],

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'               => [
        'routes' => [
            'zfcadmin'               => [
                'type'             => 'WellCart\Router\Http\Segment',
                'javascript_route' => true,
                'priority'         => -500,
                'options'          => [
                    'route'    => '/admin[/]',
                    'defaults' => [
                        'controller' => 'WellCart\Admin\Controller\Dashboard',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate'    => true,
                'child_routes'     => [
                    'login' => [
                        'type'             => 'WellCart\Router\Http\Literal',
                        'javascript_route' => true,
                        'priority'         => -500,
                        'options'          => [
                            'route'    => 'login',
                            'defaults' => [
                                'controller' => 'WellCart\Admin\Controller\Login',
                                'action'     => 'login',
                            ],
                        ],
                        'may_terminate'    => true,
                    ],

                    'logout'          => [
                        'type'             => 'WellCart\Router\Http\Literal',
                        'javascript_route' => true,
                        'priority'         => -500,
                        'options'          => [
                            'route'    => 'logout',
                            'defaults' => [
                                'controller' => 'WellCart\Admin\Controller\Logout',
                                'action'     => 'logout',
                            ],
                        ],
                        'may_terminate'    => true,
                    ],
                    'system-settings' => [
                        'type'             => 'WellCart\Router\Http\Segment',
                        'javascript_route' => true,
                        'priority'         => -500,
                        'options'          => [
                            'route'    => 'settings',
                            'defaults' => [
                                'controller' => 'WellCart\Admin\Controller\Settings',
                                'action'     => 'update',
                            ],
                        ],
                        'may_terminate'    => true,
                        'child_routes'     => [
                            'sections' => [
                                'type'          => 'WellCart\Router\Http\Wildcard',
                                'priority'      => -500,
                                'options'       => [
                                    'defaults' => [
                                        'section' => 'general',
                                    ],
                                ],
                                'may_terminate' => true,
                            ],
                        ],
                    ],


                    'admin' => [
                        'type'         => 'WellCart\Router\Http\Literal',
                        'priority'     => -500,
                        'options'      => [
                            'route'    => 'admin/',
                            'defaults' => [
                                'controller' => 'WellCart\Admin\Controller\Admin\Accounts',
                                'action'     => 'list',
                            ],
                        ],
                        'child_routes' => [
                            'accounts'      => [
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
                                        'controller' => 'WellCart\Admin\Controller\Admin\Accounts',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'notifications' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'notifications[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|delete|mark-as-read|group-action-handler)',
                                        'id'         => '([0-9]+|delete|mark-as-read)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Admin\Controller\Admin\Notifications',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                        ],
                    ],


                ],
            ],
            'admin-account-recovery' => [
                'type'             => 'WellCart\Router\Http\Literal',
                'priority'         => -500,
                'javascript_route' => true,
                'options'          => [
                    'route'    => '/admin/recover',
                    'defaults' => [
                        'controller' => 'WellCart\Admin\Controller\RecoverAccount',
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
                                'controller' => 'WellCart\Admin\Controller\RecoverAccount',
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
                                'controller' => 'WellCart\Admin\Controller\RecoverAccount',
                                'action'     => 'reset',
                                'token'      => '',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'listeners'            => [
        EventListener\SetupPageVariables::class                  => EventListener\SetupPageVariables::class,
        'WellCart\Admin\Rbac\View\Strategy\UnauthorizedStrategy' => 'WellCart\Admin\Rbac\View\Strategy\UnauthorizedStrategy',
    ],
    'system_config_editor' => include __DIR__
        . '/section/system_config_editor.php',
    'navigation'           => [
        'backend_main_navigation' => include __DIR__
            . '/backend_main_navigation.php',
    ],
    'ZfcDatagrid'          => [
        'renderer' => [
            'HtmlDataGrid' => [
                'templates'      =>
                    [
                        'layout'  => 'wellcart-admin/page-view/grid/standard/table',
                        'toolbar' => 'wellcart-admin/page-view/grid/standard/toolbar',
                    ],
                'parameterNames' => [
                    'currentPage'    => 'page',
                    'sortColumns'    => 'sortBy',
                    'sortDirections' => 'sortOrder',
                    'massIds'        => 'ids',
                ],
                'daterange'      => [
                    'enabled' => false,
                ],
            ],
        ],
    ],
    // Client-side application configuration
    'wellcart-admin'       => [
        'client-side-application' => [
            'modules' => [
                'assets/wellcart-admin/js/main-menu/module',
                'assets/wellcart-admin/js/admin/module',
            ],
        ]
    ],

    'command_bus' => [
        'command_map' => [
            Command\PersistAdminAccount::class => Command\Handler\PersistAdminAccountHandler::class,
        ],
    ],
];
