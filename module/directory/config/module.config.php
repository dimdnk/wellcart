<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Directory;

return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager'      => [
        'invokables'         => [],
        'aliases'            => [
            'wellcart_directory_db_adapter'        => 'Zend\Db\Adapter\Adapter',
            'wellcart_directory_object_manager'    => 'Doctrine\ORM\EntityManager',
            'wellcart_directory_doctrine_hydrator' => 'doctrine_hydrator',
            Spec\CountryRepository::class          => Repository\Countries::class,
            Spec\CurrencyRepository::class         => Repository\Currencies::class,
            Spec\GeoZoneMapRepository::class       => Repository\GeoZoneMaps::class,
            Spec\GeoZoneRepository::class          => Repository\GeoZones::class,
            Spec\ZoneRepository::class             => Repository\Zones::class,
        ],
        'factories'          => [],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            PageView\Admin\CurrenciesGrid::class => false,
            PageView\Admin\CurrencyForm::class   => false,
            PageView\Admin\CountriesGrid::class  => false,
            PageView\Admin\CountryForm::class    => false,
            PageView\Admin\ZonesGrid::class      => false,
            PageView\Admin\ZoneForm::class       => false,
            PageView\Admin\GeoZonesGrid::class   => false,
            PageView\Admin\GeoZoneForm::class    => false,
        ],
    ],

    'system_config_editor' => include __DIR__
        . '/section/system_config_editor.php',

    'controllers'          => [
        'invokables' => [
            'WellCart\Directory\Controller\Console\UpdateCurrencyRates' => Controller\Console\UpdateCurrencyRatesController::class,
        ],
        'factories'  => [
            'WellCart\Directory\Controller\Admin\Currencies' => Factory\Controller\Admin\CurrenciesControllerFactory::class,
            'WellCart\Directory\Controller\Admin\Countries'  => Factory\Controller\Admin\CountriesControllerFactory::class,
            'WellCart\Directory\Controller\Admin\Zones'      => Factory\Controller\Admin\ZonesControllerFactory::class,
            'WellCart\Directory\Controller\Admin\GeoZones'   => Factory\Controller\Admin\GeoZonesControllerFactory::class,
        ],
    ],

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'               => [
        'routes' => [
            'zfcadmin' => [
                'child_routes' => [
                    'directory' => [
                        'type'         => 'WellCart\Router\Http\Literal',
                        'priority'     => -500,
                        'options'      => [
                            'route'    => 'directory/',
                            'defaults' => [
                                'controller' => 'WellCart\Directory\Controller\Admin\Countries',
                                'action'     => 'list',
                            ],
                        ],
                        'child_routes' => [
                            'currencies' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'currencies[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|delete|update_rates)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Directory\Controller\Admin\Currencies',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'countries'  => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'countries[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Directory\Controller\Admin\Countries',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'zones'      => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'zones[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|get-zone-options|group-action-handler)',
                                        //'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Directory\Controller\Admin\Zones',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'geo-zones'  => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'geo-zones[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Directory\Controller\Admin\GeoZones',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'navigation'           => [
        'backend_main_navigation' => include __DIR__
            . '/backend_main_navigation.php',
    ],


    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'             => [
        'driver'          => [
            'wellcart_directory_driver' => [
                'class' => 'WellCart\ORM\Mapping\Driver\SystemConfigDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ => __DIR__ . '/../src/Entity/',
                ],
            ],
            // default metadata driver, aggregates all other drivers into a single one.
            'orm_default'               => [
                'drivers' => [
                    'WellCart\Directory\Entity' => 'wellcart_directory_driver',
                ]
            ]
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    Spec\CountryEntity::class    => Entity\Country::class,
                    Spec\CurrencyEntity::class   => Entity\Currency::class,
                    Spec\GeoZoneEntity::class    => Entity\GeoZone::class,
                    Spec\GeoZoneMapEntity::class => Entity\GeoZoneMap::class,
                    Spec\ZoneEntity::class       => Entity\Zone::class,
                    'Directory::Country'         => Entity\Country::class,
                    'Directory::Currency'        => Entity\Currency::class,
                    'Directory::GeoZone'         => Entity\GeoZone::class,
                    'Directory::GeoZoneMap'      => Entity\GeoZoneMap::class,
                    'Directory::Zone'            => Entity\Zone::class,
                ],
            ],
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

    /**
     * =========================================================
     * Object mapping configuration
     * =========================================================
     */
    'object_mapping'       => include __DIR__ . '/section/object_mapping.php',

    'console'              => [
        /**
         * =========================================================
         * Router configuration
         * =========================================================
         */
        'router' => [
            'routes' => [
                'wellcart:directory:update-currency-rates' => [
                    'options' => [
                        'route'    => 'wellcart:directory:update-currency-rates',
                        'defaults' => [
                            'controller' => 'WellCart\Directory\Controller\Console\UpdateCurrencyRates',
                            'action'     => 'handle',
                        ]
                    ]
                ],
            ]
        ]
    ],

    'cronModule'           => [
        'jobs' => [
            'wellcart:directory:update'
            => [
                'command'  => 'wellcart wellcart:directory:update-currency-rates',
                'schedule' => '*/30 * * * *'
            ],
        ]
    ],
    'layout_updates'       => include __DIR__ . '/section/layout_updates.php',
];
