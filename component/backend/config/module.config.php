<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Backend;

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

            'zfcDatagrid.renderer.HtmlDataGrid'               => PageView\Grid\Renderer::class,
            EventListener\Ui\SetupPageVariables::class        => EventListener\Ui\SetupPageVariables::class,
            EventListener\Config\RemoveConfigCacheFile::class => EventListener\Config\RemoveConfigCacheFile::class,
            ItemView\TopBranding::class                       => ItemView\TopBranding::class,
            ItemView\MainNavigationMenu::class                => ItemView\MainNavigationMenu::class,
            ItemView\Account\WelcomeBox::class                => ItemView\Account\WelcomeBox::class,

            Form\RecoverAccount::class => Form\RecoverAccount::class,

        ],
        'aliases'            => [
            'wellcart-backend_db_adapter'      => 'Zend\Db\Adapter\Adapter',
            'wellcart_admin_object_manager'    => 'Doctrine\ORM\EntityManager',
            'wellcart_admin_doctrine_hydrator' => 'doctrine_hydrator',

            Spec\AdministratorRepository::class => Repository\Administrators::class,
            Spec\NotificationRepository::class  => Repository\Notifications::class,
            'admin\notification'                => Service\Notification::class,
        ],
        'factories'          => [
            Rbac\View\Strategy\UnauthorizedStrategy::class          => Factory\Rbac\View\Strategy\UnauthorizedStrategyFactory::class,
            Command\Handler\PersistAdminAccountHandler::class       => Factory\Command\Handler\PersistAdminAccountHandlerFactory::class,
            EventListener\Entity\AdministratorEntityListener::class => Factory\EventListener\Entity\AdministratorEntityListenerFactory::class,
            'backend_main_navigation'                               => Factory\Navigation\Service\BackendMainMenuFactory::class,
        ],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            ItemView\TopBranding::class               => false,
            ItemView\MainNavigationMenu::class        => false,
            PageView\Backend\AccountsGrid::class      => false,
            PageView\Backend\AccountForm::class       => false,
            PageView\Backend\NotificationsGrid::class => false,
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

    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'        => [
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
                    'WellCart\Backend\Entity' => 'wellcart_admin_driver',
                ],
            ],
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    Spec\AdministratorEntity::class => Entity\Administrator::class,
                    'Backend::Administrator'        => Entity\Administrator::class,
                    Spec\NotificationEntity::class  => Entity\Notification::class,
                    'Backend::Notification'         => Entity\Notification::class,
                ],
            ],
        ],
    ],

    'ze_theme' => [
        'adapters' => [
            Ui\Theme\BackendRouteAdapter::class => Ui\Theme\BackendRouteAdapter::class,
        ],
    ],
    'zfcadmin' => [
        'use_admin_layout'      => true,
        'admin_layout_template' => 'layout/page-fluid-2columns',
    ],


    /**
     * Default ZfcRbac configuration for RBAC
     */
    'zfc_rbac' => [
        'guard_manager' => [
            'factories' => [
                Rbac\Guard\RouteGuard::class => Factory\Rbac\Guard\RouteGuardFactory::class,
            ],
        ],
        'guards'        => [
            Rbac\Guard\RouteGuard::class => [],
        ],
    ],

    'controllers' => [
        'aliases'   => [
            'Backend::Login'                 => Controller\LoginController::class,
            'Backend::Logout'                => Controller\LogoutController::class,
            'Backend::Dashboard'             => Controller\DashboardController::class,
            'Backend::RecoverAccount'        => Controller\RecoverAccountController::class,
            'Backend::Settings'              => Controller\SettingsController::class,
            'Backend::Backend\Accounts'      => Controller\Backend\AccountsController::class,
            'Backend::Backend\Notifications' => Controller\Backend\NotificationsController::class,
        ],
        'factories' => [
            Controller\LoginController::class                 => Factory\Controller\LoginControllerFactory::class,
            Controller\LogoutController::class                => Factory\Controller\LogoutControllerFactory::class,
            Controller\DashboardController::class             => Factory\Controller\DashboardControllerFactory::class,
            Controller\RecoverAccountController::class        => Factory\Controller\RecoverAccountControllerFactory::class,
            Controller\SettingsController::class              => Factory\Controller\SettingsControllerFactory::class,
            Controller\Backend\AccountsController::class      => Factory\Controller\Backend\AccountsControllerFactory::class,
            Controller\Backend\NotificationsController::class => Factory\Controller\Backend\NotificationsControllerFactory::class,
        ],
    ],

    'controller_plugins' => [
        'aliases'   => [
            'admin_notification' => Mvc\Controller\Plugin\Notification::class,
        ],
        'factories' => [
            Mvc\Controller\Plugin\Notification::class => Factory\ControllerPlugin\NotificationPluginFactory::class,
        ],
    ],

    'view_helpers' => [
        'aliases'   => [
            'admin_notifications' => View\Helper\Notification::class,
        ],
        'factories' => [
            View\Helper\Notification::class => Factory\ViewHelper\NotificationHelperFactory::class,
        ],
    ],

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'       => [
        'routes' => [
            'zfcadmin'               => [
                'type'             => 'WellCart\Router\Http\Segment',
                'javascript_route' => true,
                'priority'         => -500,
                'options'          => [
                    'route'    => '/admin[/]',
                    'defaults' => [
                        'controller' => 'Backend::Dashboard',
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
                                'controller' => 'Backend::Login',
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
                                'controller' => 'Backend::Logout',
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
                                'controller' => 'Backend::Settings',
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
                                'controller' => 'Backend::Backend\Accounts',
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
                                        'controller' => 'Backend::Backend\Accounts',
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
                                        'controller' => 'Backend::Backend\Notifications',
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
                        'controller' => 'Backend::RecoverAccount',
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
                                'controller' => 'Backend::RecoverAccount',
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
                                'controller' => 'Backend::RecoverAccount',
                                'action'     => 'reset',
                                'token'      => '',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'listeners'    => [
        EventListener\Ui\SetupPageVariables::class     => EventListener\Ui\SetupPageVariables::class,
        Rbac\View\Strategy\UnauthorizedStrategy::class => Rbac\View\Strategy\UnauthorizedStrategy::class,
    ],

    'ZfcDatagrid'      => [
        'renderer' => [
            'HtmlDataGrid' => [
                'templates'      =>
                    [
                        'layout'  => 'wellcart-backend/page-view/grid/standard/table',
                        'toolbar' => 'wellcart-backend/page-view/grid/standard/toolbar',
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
    'wellcart-backend' => [
        'client-side-application' => [
            'modules' => [
                'assets/wellcart-backend/js/main-menu/module',
                'assets/wellcart-backend/js/backend/module',
            ],
        ],
    ],

    'command_bus' => [
        'command_map' => [
            Command\PersistAdminAccount::class => Command\Handler\PersistAdminAccountHandler::class,
        ],
    ],
];
