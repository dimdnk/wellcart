<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager'      => [
        'invokables'         => [
            'WellCart\Admin\ItemView\PageHead'                          => 'WellCart\Admin\ItemView\PageHead',
            'WellCart\Admin\ItemView\PageNavigator'                     => 'WellCart\Admin\ItemView\PageNavigator',

            'zfcDatagrid.renderer.HtmlDataGrid'                         => 'WellCart\Admin\PageView\Grid\Renderer',
            'WellCart\Admin\EventListener\SetupPageVariables'           => 'WellCart\Admin\EventListener\SetupPageVariables',
            'WellCart\Admin\EventListener\RemoveConfigCacheFile'        => 'WellCart\Admin\EventListener\RemoveConfigCacheFile',
            'WellCart\Admin\ItemView\TopBranding'                       => 'WellCart\Admin\ItemView\TopBranding',
            'WellCart\Admin\ItemView\MainNavigationMenu'                => 'WellCart\Admin\ItemView\MainNavigationMenu',
            'WellCart\Admin\ItemView\Account\WelcomeBox'                => 'WellCart\Admin\ItemView\Account\WelcomeBox',

            'WellCart\Admin\Form\RecoverAccount'                        => 'WellCart\Admin\Form\RecoverAccount',
            'WellCart\Admin\Command\Handler\PersistAdminAccountHandler' => 'WellCart\Admin\Command\Handler\PersistAdminAccountHandler',
        ],
        'aliases'            => [
            'wellcart-admin_db_adapter'                   => 'Zend\Db\Adapter\Adapter',
            'wellcart_admin_object_manager'               => 'Doctrine\ORM\EntityManager',
            'wellcart_admin_doctrine_hydrator'            => 'doctrine_hydrator',

            'WellCart\Admin\Spec\AdministratorRepository' => 'WellCart\Admin\Repository\Administrators',
            'WellCart\Admin\Spec\NotificationRepository'  => 'WellCart\Admin\Repository\Notifications',
            'admin\notification'                          => 'WellCart\Admin\Service\Notification',
        ],
        'factories'          => [
            'WellCart\Admin\Rbac\View\Strategy\UnauthorizedStrategy' => 'WellCart\Admin\Rbac\View\Strategy\UnauthorizedStrategyFactory',
            'backend_main_navigation'                                => 'WellCart\Admin\Navigation\Service\BackendMainMenuFactory',
        ],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            'WellCart\Admin\ItemView\TopBranding'             => false,
            'WellCart\Admin\ItemView\MainNavigationMenu'      => false,
            'WellCart\Admin\PageView\Admin\AccountsGrid'      => false,
            'WellCart\Admin\PageView\Admin\AccountForm'       => false,
            'WellCart\Admin\PageView\Admin\NotificationsGrid' => false,
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

    /**
     * =========================================================
     * Translator configuration
     * =========================================================
     */
    'translator'           => [
        'translation_file_patterns' => [
            __FILE__ => [
                'text_domain' => 'default',
                'type'        => 'gettext',
                'base_dir'    => __DIR__ . '/../language',
                'pattern'     => '%s.mo',
            ],
        ],
    ],

    'context_specific'     => include __DIR__ . '/section/context_specific.php',

    /**
     * =========================================================
     * Object mapping configuration
     * =========================================================
     */
    'object_mapping'       => include __DIR__ . '/section/object_mapping.php',
    'layout_updates'       => include __DIR__ . '/section/layout_updates.php',

    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'             => [
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
                    'WellCart\Admin\Spec\AdministratorEntity' => 'WellCart\Admin\Entity\Administrator',
                    'Admin::Administrator'                    => 'WellCart\Admin\Entity\Administrator',
                    'WellCart\Admin\Spec\NotificationEntity'  => 'WellCart\Admin\Entity\Notification',
                    'Admin::Notification'                     => 'WellCart\Admin\Entity\Notification',
                ]
            ]
        ],
    ],

    'ze_theme'             => [
        'adapters' => [
            'WellCart\Admin\Ui\Theme\AdminRouteAdapter' => 'WellCart\Admin\Ui\Theme\AdminRouteAdapter',
        ],
    ],
    'zfcadmin'             => [
        'use_admin_layout'      => true,
        'admin_layout_template' => 'layout/page-fluid-2columns',
    ],

    /**
     * =========================================================
     * View manager configuration
     * =========================================================
     */
    'view_manager'         => [
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
    'zfc_rbac'             => [
        'guards' => [
            'ZfcRbac\Guard\RouteGuard' => [
                'zfcadmin*' => ['admin' => 'admin'],
            ]
        ],
    ],
    'event_manager'        => include __DIR__ . '/section/event_manager.php',

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
                    'login'           => [
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


                    'admin'           => [
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
        'WellCart\Admin\EventListener\SetupPageVariables'        => 'WellCart\Admin\EventListener\SetupPageVariables',
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

    'command_bus'          => [
        'command_map' => [
            'WellCart\Admin\Command\PersistAdminAccount' => 'WellCart\Admin\Command\Handler\PersistAdminAccountHandler',
        ],
    ],
];
