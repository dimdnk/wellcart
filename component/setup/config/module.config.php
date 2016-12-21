<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Setup;

return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager' => [
        'invokables'         => [
            ItemView\Header::class => ItemView\Header::class,
        ],
        'factories'          => [],
        'abstract_factories' => [],
        'aliases'            => [
            'wellcart_setup_service' => 'WellCart\Setup\Service\Setup',
        ],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            ItemView\Header::class => false,
        ],
    ],

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'          => [
        'routes' => [
            'setup' => [
                'type'             => 'WellCart\Router\Http\Literal',
                'javascript_route' => true,
                'priority'         => -500,
                'options'          => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'Setup::Wizard',
                        'action'     => 'process',
                    ],
                ],
            ],
        ],
    ],
    'controllers'     => [
        'aliases'    => [
            'Setup::Wizard'                  => Controller\WizardController::class,
            'Setup::ConsoleSetup'            => Controller\ConsoleSetupController::class,
            'Setup::Console\MaintenanceMode' => Controller\Console\MaintenanceModeController::class,
        ],
        'invokables' => [
            Controller\WizardController::class                  => Controller\WizardController::class,
            Controller\ConsoleSetupController::class            => Controller\ConsoleSetupController::class,
            Controller\Console\MaintenanceModeController::class => Controller\Console\MaintenanceModeController::class,
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
    'console'         => [
        /**
         * =========================================================
         * Router configuration
         * =========================================================
         */
        'router' => [
            'routes' => [
                'maintenance:status' => [
                    'options' => [
                        'route'    => 'maintenance:status',
                        'defaults' => [
                            'controller' => 'Setup::Console\MaintenanceMode',
                            'action'     => 'status',
                        ],
                    ],
                ],

                'maintenance:enable' => [
                    'options' => [
                        'route'    => 'maintenance:enable',
                        'defaults' => [
                            'controller' => 'Setup::Console\MaintenanceMode',
                            'action'     => 'enable',
                        ],
                    ],
                ],

                'maintenance:disable' => [
                    'options' => [
                        'route'    => 'maintenance:disable',
                        'defaults' => [
                            'controller' => 'Setup::Console\MaintenanceMode',
                            'action'     => 'disable',
                        ],
                    ],
                ],

                'setup'               => [
                    'options' => [
                        'route'    => 'setup [--db-driver=<db-driver>] [--db-host=<db-host>] [--db-port=<db-port>] --db-name=<db-name> --db-username=<db-username> [--db-password=<db-password>] --admin-email=<admin-email> --admin-password=<admin-password> --admin-first-name=<admin-first-name> --admin-last-name=<admin-last-name> --base-path=<base-path> [--website-name=<website-name>]',
                        'defaults' => [
                            'controller'  => 'Setup::ConsoleSetup',
                            'action'      => 'handle',
                            'db-driver'   => 'pdo_mysql',
                            'db-port'     => 3306,
                            'db-host'     => 'localhost',
                            'db-name'     => 'wellcart',
                            'db-username' => 'root',
                        ]
                    ]
                ],
                'setup:upgrade'        => [
                    'options' => [
                        'route'    => 'setup:upgrade',
                        'defaults' => [
                            'controller' => 'Setup::ConsoleSetup',
                            'action'     => 'upgrade',
                        ]
                    ]
                ],
                'setup:publish-assets' => [
                    'options' => [
                        'route'    => 'setup:publish-assets',
                        'defaults' => [
                            'controller' => 'Setup::ConsoleSetup',
                            'action'     => 'publish-assets',
                        ]
                    ]
                ],
            ]
        ]
    ],
];
