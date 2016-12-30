<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'                 => [
        'routes' => [
            'api' => [
                'child_routes' => [
                    'directory:countries'     => [
                        'type'     => 'WellCart\Router\Http\Segment',
                        'priority' => -500,
                        'options'  => [
                            'route'    => 'directory/countries[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Directory\RestApi\V1\Countries\Controller',
                            ],
                        ],
                    ],
                    'directory:currencies'    => [
                        'type'     => 'WellCart\Router\Http\Segment',
                        'priority' => -500,
                        'options'  => [
                            'route'    => 'directory/currencies[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Directory\RestApi\V1\Currencies\Controller',
                            ],
                        ],
                    ],
                    'directory:geo-zones'     => [
                        'type'     => 'WellCart\Router\Http\Segment',
                        'priority' => -500,
                        'options'  => [
                            'route'    => 'directory/geo-zones[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Directory\RestApi\V1\GeoZones\Controller',
                            ],
                        ],
                    ],
                    'directory:geo-zone-maps' => [
                        'type'     => 'WellCart\Router\Http\Segment',
                        'priority' => -500,
                        'options'  => [
                            'route'    => 'directory/geo-zone-map[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Directory\RestApi\V1\GeoZoneMaps\Controller',
                            ],
                        ],
                    ],
                    'directory:zones'         => [
                        'type'     => 'WellCart\Router\Http\Segment',
                        'priority' => -500,
                        'options'  => [
                            'route'    => 'directory/zones[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Directory\RestApi\V1\Zones\Controller',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning'          => [
        'uri' => [
            'api/directory:countries',
            'api/directory:currencies',
            'api/directory:geo-zones',
            'api/directory:geo-zone-maps',
            'api/directory:zones',
        ],
    ],
    'zf-rest'                => [
        'WellCart\Directory\RestApi\V1\Countries\Controller'   => [
            'listener'                   => 'WellCart\Directory\RestApi\V1\Countries\CountryResource',
            'route_name'                 => 'api/directory:countries',
            'route_identifier_name'      => 'id',
            'entity_identifier_name'     => 'id',
            'page_size'                  => 1000,
            'entity_http_methods'        => [
                'GET',
                'PATCH',
                'PUT',
                'DELETE',
            ],
            'collection_http_methods'    => [
                'GET',
                'POST',
            ],
            'collection_query_whitelist' => [],
            'entity_class'               => 'WellCart\Directory\Spec\CountryEntity',
            'collection_class'           => 'WellCart\Directory\RestApi\V1\Countries\CountryCollection',
        ],
        'WellCart\Directory\RestApi\V1\Currencies\Controller'  => [
            'listener'                   => 'WellCart\Directory\RestApi\V1\Currencies\CurrencyResource',
            'route_name'                 => 'api/directory:currencies',
            'route_identifier_name'      => 'id',
            'entity_identifier_name'     => 'id',
            'page_size'                  => 1000,
            'entity_http_methods'        => [
                'GET',
                'PATCH',
                'PUT',
                'DELETE',
            ],
            'collection_http_methods'    => [
                'GET',
                'POST',
            ],
            'collection_query_whitelist' => [],
            'entity_class'               => 'WellCart\Directory\Spec\CurrencyEntity',
            'collection_class'           => 'WellCart\Directory\RestApi\V1\Currencies\CurrencyCollection',
        ],
        'WellCart\Directory\RestApi\V1\GeoZones\Controller'    => [
            'listener'                   => 'WellCart\Directory\RestApi\V1\GeoZones\GeoZoneResource',
            'route_name'                 => 'api/directory:geo-zones',
            'route_identifier_name'      => 'id',
            'entity_identifier_name'     => 'id',
            'page_size'                  => 1000,
            'entity_http_methods'        => [
                'GET',
                'PATCH',
                'PUT',
                'DELETE',
            ],
            'collection_http_methods'    => [
                'GET',
                'POST',
            ],
            'collection_query_whitelist' => [],
            'entity_class'               => 'WellCart\Directory\Spec\GeoZoneEntity',
            'collection_class'           => 'WellCart\Directory\RestApi\V1\GeoZones\GeoZoneCollection',
        ],
        'WellCart\Directory\RestApi\V1\GeoZoneMaps\Controller' => [
            'listener'                   => 'WellCart\Directory\RestApi\V1\GeoZoneMaps\GeoZoneMapResource',
            'route_name'                 => 'api/directory:geo-zone-maps',
            'route_identifier_name'      => 'id',
            'entity_identifier_name'     => 'id',
            'page_size'                  => 1000,
            'entity_http_methods'        => [
                'GET',
                'PATCH',
                'PUT',
                'DELETE',
            ],
            'collection_http_methods'    => [
                'GET',
                'POST',
            ],
            'collection_query_whitelist' => [],
            'entity_class'               => 'WellCart\Directory\Spec\GeoZoneMapEntity',
            'collection_class'           => 'WellCart\Directory\RestApi\V1\GeoZoneMaps\GeoZoneMapCollection',
        ],
        'WellCart\Directory\RestApi\V1\Zones\Controller'       => [
            'listener'                   => 'WellCart\Directory\RestApi\V1\Zones\ZoneResource',
            'route_name'                 => 'api/directory:zones',
            'route_identifier_name'      => 'id',
            'entity_identifier_name'     => 'id',
            'entity_http_methods'        => [
                'GET',
                'PATCH',
                'PUT',
                'DELETE',
            ],
            'collection_http_methods'    => [
                'GET',
                'POST',
            ],
            'collection_query_whitelist' => [],
            'entity_class'               => 'WellCart\Directory\Spec\ZoneEntity',
            'collection_class'           => 'WellCart\Directory\RestApi\V1\Zones\ZoneCollection',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers'            => [
            'WellCart\Directory\RestApi\V1\Countries\Controller'   => 'HalJson',
            'WellCart\Directory\RestApi\V1\Currencies\Controller'  => 'HalJson',
            'WellCart\Directory\RestApi\V1\GeoZones\Controller'    => 'HalJson',
            'WellCart\Directory\RestApi\V1\GeoZoneMaps\Controller' => 'HalJson',
            'WellCart\Directory\RestApi\V1\Zones\Controller'       => 'HalJson',
        ],
        'accept-whitelist'       => [
            'WellCart\Directory\RestApi\V1\Countries\Controller'   => [
                'application/json',
            ],
            'WellCart\Directory\RestApi\V1\Currencies\Controller'  => [
                'application/json',
            ],
            'WellCart\Directory\RestApi\V1\GeoZones\Controller'    => [
                'application/json',
            ],
            'WellCart\Directory\RestApi\V1\GeoZoneMaps\Controller' => [
                'application/json',
            ],
            'WellCart\Directory\RestApi\V1\Zones\Controller'       => [
                'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'WellCart\Directory\RestApi\V1\Countries\Controller'   => [
                'application/json',
            ],
            'WellCart\Directory\RestApi\V1\Currencies\Controller'  => [
                'application/json',
            ],
            'WellCart\Directory\RestApi\V1\GeoZones\Controller'    => [
                'application/json',
            ],
            'WellCart\Directory\RestApi\V1\GeoZoneMaps\Controller' => [
                'application/json',
            ],
            'WellCart\Directory\RestApi\V1\Zones\Controller'       => [
                'application/json',
            ],
        ],
    ],
    'zf-hal'                 => [
        'metadata_map' => [
            'WellCart\Directory\Entity\Country'                              => [
                'route_name'             => 'api/directory:countries',
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'hydrator'               => 'WellCart\Directory\RestApi\V1\Countries\CountryHydrator',
            ],
            'WellCart\Directory\RestApi\V1\Countries\CountryCollection'      => [
                'route_name' => 'api/directory:countries',
            ],
            'WellCart\Directory\Entity\Currency'                             => [
                'route_name'             => 'api/directory:currencies',
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'hydrator'               => 'WellCart\Directory\RestApi\V1\Currencies\CurrencyHydrator',
            ],
            'WellCart\Directory\RestApi\V1\Currencies\CurrencyCollection'    => [
                'route_name' => 'api/directory:currencies',
            ],
            'WellCart\Directory\Entity\GeoZone'                              => [
                'route_name'             => 'api/directory:geo-zones',
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'hydrator'               => 'WellCart\Directory\RestApi\V1\GeoZones\GeoZoneHydrator',
            ],
            'WellCart\Directory\RestApi\V1\GeoZones\GeoZoneCollection'       => [
                'route_name' => 'api/directory:geo-zones',
            ],
            'WellCart\Directory\Entity\GeoZoneMap'                           => [
                'route_name'             => 'api/directory:geo-zone-maps',
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'hydrator'               => 'WellCart\Directory\RestApi\V1\GeoZoneMaps\GeoZoneMapHydrator',
            ],
            'WellCart\Directory\RestApi\V1\GeoZoneMaps\GeoZoneMapCollection' => [
                'route_name' => 'api/directory:geo-zone-maps',
            ],
            'WellCart\Directory\Entity\Zone'                                 => [
                'route_name'             => 'api/directory:zones',
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'hydrator'               => 'WellCart\Directory\RestApi\V1\Zones\ZoneHydrator',
            ],
            'WellCart\Directory\RestApi\V1\Zones\ZoneCollection'             => [
                'route_name' => 'api/directory:zones',
            ],
        ],
    ],
    'zf-apigility'           => [
        'doctrine-connected' => [
            'WellCart\Directory\RestApi\V1\Countries\CountryResource'      => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Directory\RestApi\V1\Countries\CountryHydrator',
            ],
            'WellCart\Directory\RestApi\V1\Currencies\CurrencyResource'    => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Directory\RestApi\V1\Currencies\CurrencyHydrator',
            ],
            'WellCart\Directory\RestApi\V1\GeoZones\GeoZoneResource'       => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Directory\RestApi\V1\GeoZones\GeoZoneHydrator',
            ],
            'WellCart\Directory\RestApi\V1\GeoZoneMaps\GeoZoneMapResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Directory\RestApi\V1\GeoZoneMaps\GeoZoneMapHydrator',
            ],
            'WellCart\Directory\RestApi\V1\Zones\ZoneResource'             => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Directory\RestApi\V1\Zones\ZoneHydrator',
            ],
        ],
    ],
    'doctrine-hydrator'      => [
        'WellCart\Directory\RestApi\V1\Countries\CountryHydrator'      => [
            'entity_class'    => 'WellCart\Directory\Spec\CountryEntity',
            'object_manager'  => 'doctrine.entitymanager.orm_default',
            'by_value'        => true,
            'naming_strategy' => 'UnderscoreNamingStrategy',
        ],
        'WellCart\Directory\RestApi\V1\Currencies\CurrencyHydrator'    => [
            'entity_class'    => 'WellCart\Directory\Spec\CurrencyEntity',
            'object_manager'  => 'doctrine.entitymanager.orm_default',
            'by_value'        => true,
            'naming_strategy' => 'UnderscoreNamingStrategy',
        ],
        'WellCart\Directory\RestApi\V1\GeoZones\GeoZoneHydrator'       => [
            'entity_class'    => 'WellCart\Directory\Spec\GeoZoneEntity',
            'object_manager'  => 'doctrine.entitymanager.orm_default',
            'by_value'        => true,
            'naming_strategy' => 'UnderscoreNamingStrategy',
        ],
        'WellCart\Directory\RestApi\V1\GeoZoneMaps\GeoZoneMapHydrator' => [
            'entity_class'    => 'WellCart\Directory\Spec\GeoZoneMapEntity',
            'object_manager'  => 'doctrine.entitymanager.orm_default',
            'by_value'        => true,
            'naming_strategy' => 'UnderscoreNamingStrategy',
        ],
        'WellCart\Directory\RestApi\V1\Zones\ZoneHydrator'             => [
            'entity_class'    => 'WellCart\Directory\Spec\ZoneEntity',
            'object_manager'  => 'doctrine.entitymanager.orm_default',
            'by_value'        => true,
            'naming_strategy' => 'UnderscoreNamingStrategy',
        ],
    ],
    'zf-content-validation'  => [
        'WellCart\Directory\RestApi\V1\Countries\Controller'   => [
            'input_filter' => 'WellCart\Directory\Spec\CountryEntity',
        ],
        'WellCart\Directory\RestApi\V1\Currencies\Controller'  => [
            'input_filter' => 'WellCart\Directory\Spec\CurrencyEntity',
        ],
        'WellCart\Directory\RestApi\V1\GeoZones\Controller'    => [
            'input_filter' => 'WellCart\Directory\Spec\GeoZoneEntity',
        ],
        'WellCart\Directory\RestApi\V1\GeoZoneMaps\Controller' => [
            'input_filter' => 'WellCart\Directory\Spec\GeoZoneMapEntity',
        ],
        'WellCart\Directory\RestApi\V1\Zones\Controller'       => [
            'input_filter' => 'WellCart\Directory\Spec\ZoneEntity',
        ],
    ],
    'zf-mvc-auth'            => [
        'authentication' => [
            'map' => [
                'WellCart\Directory\Rest' => 'oauth2_doctrine',
            ],
        ],
        'authorization'  => [
            'WellCart\Directory\RestApi\V1\Countries\Controller' => [
                'collection' => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
                'entity'     => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
            ],

            'WellCart\Directory\RestApi\V1\Currencies\Controller' => [
                'collection' => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
                'entity'     => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
            ],

            'WellCart\Directory\RestApi\V1\GeoZones\Controller' => [
                'collection' => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
                'entity'     => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
            ],

            'WellCart\Directory\RestApi\V1\GeoZoneMaps\Controller' => [
                'collection' => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
                'entity'     => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
            ],

            'WellCart\Directory\RestApi\V1\Zones\Controller' => [
                'collection' => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
                'entity'     => [
                    'GET'    => true,
                    'POST'   => true,
                    'PUT'    => true,
                    'PATCH'  => true,
                    'DELETE' => true,
                ],
            ],

        ],
    ],
];
