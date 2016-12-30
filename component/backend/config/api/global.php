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
    'router' => [
        'routes' => [
            'api' => [
                'child_routes' => [
                    'admin:administrators' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'admin/administrators[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Backend\RestApi\V1\Administrators\Controller',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'zf-versioning'          => [
        'uri' => [
            'api/admin:administrators',
        ],
    ],
    'zf-rest'                => [
        'WellCart\Backend\RestApi\V1\Administrators\Controller' => [
            'listener'                   => 'WellCart\Backend\RestApi\V1\Administrators\AdministratorResource',
            'route_name'                 => 'api/admin:administrators',
            'route_identifier_name'      => 'id',
            'entity_identifier_name'     => 'id',
            'collection_name'            => 'items',
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
            'page_size'                  => 50,
            'page_size_param'            => 'limit',
            'entity_class'               => 'WellCart\Backend\Spec\AdministratorEntity',
            'collection_class'           => 'WellCart\Backend\RestApi\V1\Administrators\AdministratorCollection',
            'service_name'               => 'Administrator',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers'            => [
            'WellCart\Backend\RestApi\V1\Administrators\Controller' => 'HalJson',
        ],
        'accept-whitelist'       => [
            'WellCart\Backend\RestApi\V1\Administrators\Controller' => [
                'application/hal+json',
                'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'WellCart\Backend\RestApi\V1\Administrators\Controller' => [
                'application/json',
            ],
        ],
    ],
    'zf-hal'                 => [
        'metadata_map' => [
            'WellCart\Backend\Entity\Administrator'                              => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/admin:administrators',
                'hydrator'               => 'WellCart\Backend\RestApi\V1\Administrators\AdministratorHydrator',
            ],
            'WellCart\Backend\RestApi\V1\Administrators\AdministratorCollection' => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/admin:administrators',
                'is_collection'          => true,
            ],
        ],
    ],
    'zf-apigility'           => [
        'doctrine-connected' => [
            'WellCart\Backend\RestApi\V1\Administrators\AdministratorResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Backend\RestApi\V1\Administrators\AdministratorHydrator',
            ],
        ],
    ],
    'doctrine-hydrator'      => [
        'WellCart\Backend\RestApi\V1\Administrators\AdministratorHydrator' => [
            'entity_class'           => 'WellCart\Backend\Spec\AdministratorEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation'  => [
        'WellCart\Backend\RestApi\V1\Administrators\Controller' => [
            'input_filter' => 'WellCart\Backend\Spec\AdministratorEntity',
        ],
    ],
    'zf-mvc-auth'            => [
        'authentication' => [
            'map' => [
                'WellCart\Backend\Rest' => 'oauth2_doctrine',
            ],
        ],
        'authorization'  => [
            'WellCart\Backend\RestApi\V1\Administrators\Controller' => [
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
