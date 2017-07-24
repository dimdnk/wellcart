<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Directory;

return [
    'domain' => [
        'mapping' => [
            Entity\Country::class    =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\Countries::class,
                    'table'           => 'directory_countries',
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'country_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'fields'          =>
                        [
                            'name'             =>
                                [
                                    'column'   => 'name',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'status'           =>
                                [
                                    'column'   => 'status',
                                    'type'     => 'integer',
                                    'nullable' => false,
                                ],
                            'postcodeRequired' =>
                                [
                                    'column'   => 'postcode_required',
                                    'type'     => 'boolean',
                                    'nullable' => true,
                                ],
                            'addressFormat'    =>
                                [
                                    'column'   => 'address_format',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'isoCode2'         =>
                                [
                                    'column'   => 'iso_code_2',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'isoCode3'         =>
                                [
                                    'column'   => 'iso_code_3',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'createdAt'        =>
                                [
                                    'column'   => 'created_at',
                                    'type'     => 'timestamp',
                                    'nullable' => false,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'create',
                                                ],
                                        ],
                                ],
                            'updatedAt'        =>
                                [
                                    'column'   => 'updated_at',
                                    'type'     => 'timestamp',
                                    'nullable' => true,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'update',
                                                ],
                                        ],
                                ],
                        ],
                ],
            Entity\Currency::class   =>
                [
                    'type'            => 'entity',
                    'entityListeners' => [
                        EventListener\Entity\CurrencyEntityListener::class => [
                            'prePersist'  => ['prePersist' => 'prePersist'],
                            'preUpdate'   => ['prePersist' => 'preUpdate'],
                            'postPersist' => ['postPersist' => 'postPersist'],
                            'postUpdate'  => ['postUpdate' => 'postUpdate'],
                            'preRemove'   => ['preRemove' => 'preRemove'],
                        ],
                    ],
                    'repositoryClass' => Repository\Currencies::class,
                    'table'           => 'directory_currencies',
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'currency_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'fields'          =>
                        [
                            'title'              =>
                                [
                                    'column'   => 'title',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'code'               =>
                                [
                                    'column'   => 'code',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'symbol'             =>
                                [
                                    'column'   => 'symbol',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'symbolPosition'     =>
                                [
                                    'column'   => 'symbol_position',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'exchangeRate'       =>
                                [
                                    'column'   => 'exchange_rate',
                                    'type'     => 'decimal',
                                    'nullable' => true,
                                ],
                            'decimals'           =>
                                [
                                    'column'   => 'decimals',
                                    'type'     => 'integer',
                                    'nullable' => true,
                                ],
                            'decimalsSeparator'  =>
                                [
                                    'column'   => 'decimals_separator',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'thousandsSeparator' =>
                                [
                                    'column'   => 'thousands_separator',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'status'             =>
                                [
                                    'column'   => 'status',
                                    'type'     => 'integer',
                                    'nullable' => true,
                                ],
                            'isPrimary'          =>
                                [
                                    'column'   => 'is_primary',
                                    'type'     => 'boolean',
                                    'nullable' => true,
                                ],
                            'createdAt'          =>
                                [
                                    'column'   => 'created_at',
                                    'type'     => 'timestamp',
                                    'nullable' => false,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'create',
                                                ],
                                        ],
                                ],
                            'updatedAt'          =>
                                [
                                    'column'   => 'updated_at',
                                    'type'     => 'timestamp',
                                    'nullable' => true,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'update',
                                                ],
                                        ],
                                ],
                        ],
                ],
            Entity\GeoZone::class    =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\GeoZones::class,
                    'table'           => 'directory_geo_zones',
                    'oneToMany'       => [
                        'geoZoneMaps' => [
                            'targetEntity'  => Entity\GeoZoneMap::class,
                            'mappedBy'      => 'geoZone',
                            'orphanRemoval' => true,
                            'cascade'       => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'geo_zone_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'fields'          =>
                        [
                            'name'        =>
                                [
                                    'column'   => 'name',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'description' =>
                                [
                                    'column'   => 'description',
                                    'type'     => 'string',
                                    'nullable' => true,
                                ],
                            'createdAt'   =>
                                [
                                    'column'   => 'created_at',
                                    'type'     => 'timestamp',
                                    'nullable' => false,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'create',
                                                ],
                                        ],
                                ],
                            'updatedAt'   =>
                                [
                                    'column'   => 'updated_at',
                                    'type'     => 'timestamp',
                                    'nullable' => true,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'update',
                                                ],
                                        ],
                                ],
                        ],
                ],
            Entity\GeoZoneMap::class =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\GeoZoneMaps::class,
                    'table'           => 'directory_zone_to_geo_zone',
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'zone_to_geo_zone_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToOne'        => [
                        'country' => [
                            'targetEntity' => Entity\Country::class,
                            'joinColumn'   => [
                                'name'                 => 'country_id',
                                'referencedColumnName' => 'country_id',
                            ],
                        ],
                        'zone'    => [
                            'targetEntity' => Entity\Zone::class,
                            'joinColumn'   => [
                                'name'                 => 'zone_id',
                                'referencedColumnName' => 'zone_id',
                            ],
                        ],
                    ],
                    'manyToOne'       => [
                        'geoZone' => [
                            'targetEntity' => Entity\GeoZone::class,
                            'inversedBy'   => 'geoZoneMaps',
                            'joinColumn'   => [
                                'name'                 => 'geo_zone_id',
                                'referencedColumnName' => 'geo_zone_id',
                            ],
                        ],
                    ],
                    'fields'          =>
                        [
                            'countryId' =>
                                [
                                    'column'   => 'country_id',
                                    'type'     => 'integer',
                                    'nullable' => true,
                                ],
                            'zoneId'    =>
                                [
                                    'column'   => 'zone_id',
                                    'type'     => 'integer',
                                    'nullable' => true,
                                ],
                            'geoZoneId' =>
                                [
                                    'column'   => 'geo_zone_id',
                                    'type'     => 'integer',
                                    'nullable' => true,
                                ],
                            'createdAt' =>
                                [
                                    'column'   => 'created_at',
                                    'type'     => 'timestamp',
                                    'nullable' => false,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'create',
                                                ],
                                        ],
                                ],
                            'updatedAt' =>
                                [
                                    'column'   => 'updated_at',
                                    'type'     => 'timestamp',
                                    'nullable' => true,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'update',
                                                ],
                                        ],
                                ],
                        ],
                ],
            Entity\Zone::class       =>
                [
                    'type'            => 'entity',
                    'repositoryClass' => Repository\Zones::class,
                    'table'           => 'directory_zones',
                    'oneToOne'        => [
                        'country' => [
                            'targetEntity' => Entity\Country::class,
                            'joinColumn'   => [
                                'name'                 => 'country_id',
                                'referencedColumnName' => 'country_id',
                            ],
                        ],
                    ],
                    'id'              =>
                        [
                            'id' =>
                                [
                                    'column'    => 'zone_id',
                                    'type'      => 'integer',
                                    'nullable'  => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'fields'          =>
                        [
                            'name'      =>
                                [
                                    'column'   => 'name',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'code'      =>
                                [
                                    'column'   => 'code',
                                    'type'     => 'string',
                                    'nullable' => false,
                                ],
                            'status'    =>
                                [
                                    'column'   => 'status',
                                    'type'     => 'integer',
                                    'nullable' => false,
                                ],
                            'countryId' =>
                                [
                                    'column'   => 'country_id',
                                    'type'     => 'integer',
                                    'nullable' => true,
                                ],
                            'createdAt' =>
                                [
                                    'column'   => 'created_at',
                                    'type'     => 'timestamp',
                                    'nullable' => false,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'create',
                                                ],
                                        ],
                                ],
                            'updatedAt' =>
                                [
                                    'column'   => 'updated_at',
                                    'type'     => 'timestamp',
                                    'nullable' => true,
                                    'gedmo'    =>
                                        [
                                            'timestampable' =>
                                                [
                                                    'on' => 'update',
                                                ],
                                        ],
                                ],
                        ],
                ],
        ],
    ],
];
