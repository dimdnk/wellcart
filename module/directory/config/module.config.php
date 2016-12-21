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
            'directory:update-currency-rates'
            => [
                'command'  => 'wellcart directory:update-currency-rates',
                'schedule' => '*/30 * * * *'
            ],
        ]
    ],
];
