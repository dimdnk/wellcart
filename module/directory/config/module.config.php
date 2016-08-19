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
        'invokables'         => [],
        'aliases'            => [
            'wellcart_directory_db_adapter'                => 'Zend\Db\Adapter\Adapter',
            'wellcart_directory_object_manager'            => 'Doctrine\ORM\EntityManager',
            'wellcart_directory_doctrine_hydrator'         => 'doctrine_hydrator',
            'WellCart\Directory\Spec\CountryRepository'    => 'WellCart\Directory\Repository\Countries',
            'WellCart\Directory\Spec\CurrencyRepository'   => 'WellCart\Directory\Repository\Currencies',
            'WellCart\Directory\Spec\GeoZoneMapRepository' => 'WellCart\Directory\Repository\GeoZoneMaps',
            'WellCart\Directory\Spec\GeoZoneRepository'    => 'WellCart\Directory\Repository\GeoZones',
            'WellCart\Directory\Spec\ZoneRepository'       => 'WellCart\Directory\Repository\Zones',
        ],
        'factories'          => [],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            'WellCart\Directory\PageView\Admin\CurrenciesGrid' => false,
            'WellCart\Directory\PageView\Admin\CurrencyForm'   => false,
            'WellCart\Directory\PageView\Admin\CountriesGrid'  => false,
            'WellCart\Directory\PageView\Admin\CountryForm'    => false,
            'WellCart\Directory\PageView\Admin\ZonesGrid'      => false,
            'WellCart\Directory\PageView\Admin\ZoneForm'       => false,
            'WellCart\Directory\PageView\Admin\GeoZonesGrid'   => false,
            'WellCart\Directory\PageView\Admin\GeoZoneForm'    => false,
        ],
    ],

    'system_config_editor' => include __DIR__
        . '/section/system_config_editor.php',

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
                    'WellCart\Directory\Spec\CountryEntity'    => 'WellCart\Directory\Entity\Country',
                    'WellCart\Directory\Spec\CurrencyEntity'   => 'WellCart\Directory\Entity\Currency',
                    'WellCart\Directory\Spec\GeoZoneEntity'    => 'WellCart\Directory\Entity\GeoZone',
                    'WellCart\Directory\Spec\GeoZoneMapEntity' => 'WellCart\Directory\Entity\GeoZoneMap',
                    'WellCart\Directory\Spec\ZoneEntity'       => 'WellCart\Directory\Entity\Zone',
                    'Directory::Country'                       => 'WellCart\Directory\Entity\Country',
                    'Directory::Currency'                      => 'WellCart\Directory\Entity\Currency',
                    'Directory::GeoZone'                       => 'WellCart\Directory\Entity\GeoZone',
                    'Directory::GeoZoneMap'                    => 'WellCart\Directory\Entity\GeoZoneMap',
                    'Directory::Zone'                          => 'WellCart\Directory\Entity\Zone',
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
    'view_helpers'         => [
        'invokables' => [
            'formDirectoryGeoZoneMap' => 'WellCart\Directory\Form\View\Helper\FormGeoZoneMap',
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
