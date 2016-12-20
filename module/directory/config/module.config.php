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
    'service_manager' => [
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
            PageView\Backend\CurrenciesGrid::class => false,
            PageView\Backend\CurrencyForm::class   => false,
            PageView\Backend\CountriesGrid::class  => false,
            PageView\Backend\CountryForm::class    => false,
            PageView\Backend\ZonesGrid::class      => false,
            PageView\Backend\ZoneForm::class       => false,
            PageView\Backend\GeoZonesGrid::class   => false,
            PageView\Backend\GeoZoneForm::class    => false,
        ],
    ],

    'system_config_editor' => include __DIR__
        . '/section/system_config_editor.global.php',

    'controllers' => [
        'aliases'    => [
            'Directory::Console\UpdateCurrencyRates' => Controller\Console\UpdateCurrencyRatesController::class,
            'Directory::Backend\Currencies'            => Controller\Backend\CurrenciesController::class,
            'Directory::Backend\Countries'             => Controller\Backend\CountriesController::class,
            'Directory::Backend\Zones'                 => Controller\Backend\ZonesController::class,
            'Directory::Backend\GeoZones'              => Controller\Backend\GeoZonesController::class,
        ],
        'invokables' => [
            Controller\Console\UpdateCurrencyRatesController::class => Controller\Console\UpdateCurrencyRatesController::class,
        ],
        'factories'  => [
            Controller\Backend\CurrenciesController::class => Factory\Controller\Backend\CurrenciesControllerFactory::class,
            Controller\Backend\CountriesController::class  => Factory\Controller\Backend\CountriesControllerFactory::class,
            Controller\Backend\ZonesController::class      => Factory\Controller\Backend\ZonesControllerFactory::class,
            Controller\Backend\GeoZonesController::class   => Factory\Controller\Backend\GeoZonesControllerFactory::class,
        ],
    ],

    'form_elements'  => [
        'aliases'   => [
            'directoryCountrySelector' => Form\Element\CountrySelector::class,
            'directoryZoneSelector'    => Form\Element\ZoneSelector::class,
        ],
        'factories' => [
            Form\Element\CountrySelector::class => Factory\FormElement\CountrySelectorFactory::class,
            Form\Element\ZoneSelector::class    => Factory\FormElement\ZoneSelectorFactory::class,
        ],
    ],

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'         => [
        'routes' => [
            'zfcadmin' => [
                'child_routes' => [
                    'directory' => [
                        'type'         => 'WellCart\Router\Http\Literal',
                        'priority'     => -500,
                        'options'      => [
                            'route'    => 'directory/',
                            'defaults' => [
                                'controller' => 'Directory::Backend\Countries',
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
                                        'controller' => 'Directory::Backend\Currencies',
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
                                        'controller' => 'Directory::Backend\Countries',
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
                                        'controller' => 'Directory::Backend\Zones',
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
                                        'controller' => 'Directory::Backend\GeoZones',
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

    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'       => [
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
    'asset_manager'  => [
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
    'translator'     => [
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
    'object_mapping' => include __DIR__ . '/section/object_mapping.global.php',

    'console' => [
        /**
         * =========================================================
         * Router configuration
         * =========================================================
         */
        'router' => [
            'routes' => [
                'directory:update-currency-rates' => [
                    'options' => [
                        'route'    => 'directory:update-currency-rates',
                        'defaults' => [
                            'controller' => 'Directory::Console\UpdateCurrencyRates',
                            'action'     => 'handle',
                        ]
                    ]
                ],
            ]
        ]
    ],

    'cronModule'     => [
        'jobs' => [
            'directory:update'
            => [
                'command'  => 'wellcart directory:update-currency-rates',
                'schedule' => '*/30 * * * *'
            ],
        ]
    ],
    'layout_updates' => include __DIR__ . '/section/layout_updates.global.php',
];
