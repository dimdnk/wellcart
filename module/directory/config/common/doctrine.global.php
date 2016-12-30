<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Directory;
/**
 * =========================================================
 * Doctrine configuration
 * =========================================================
 */
return [
    'doctrine' => [
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
];
