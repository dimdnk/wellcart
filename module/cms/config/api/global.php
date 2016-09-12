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
     * Router configuration
     * =========================================================
     */
    'router'                 => [
        'routes' => [
            'api' => [
                'child_routes' => [
                    'cms:pages' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'cms/pages[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\CMS\RestApi\V1\Pages\Controller',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'zf-versioning'          => [
        'uri' => [
            'api/cms:pages',
        ],
    ],
    'zf-rest'                => [
        'WellCart\CMS\RestApi\V1\Pages\Controller' => [
            'listener'                   => 'WellCart\CMS\RestApi\V1\Pages\PageResource',
            'route_name'                 => 'api/cms:pages',
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
            'entity_class'               => 'WellCart\CMS\Spec\PageEntity',
            'collection_class'           => 'WellCart\CMS\RestApi\V1\Pages\PageCollection',
            'service_name'               => 'Post',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers'            => [
            'WellCart\CMS\RestApi\V1\Pages\Controller' => 'HalJson',
        ],
        'accept-whitelist'       => [
            'WellCart\CMS\RestApi\V1\Pages\Controller' => [
                'application/hal+json',
                'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'WellCart\CMS\RestApi\V1\Pages\Controller' => [
                'application/json',
            ],
        ],
    ],
    'zf-hal'                 => [
        'metadata_map' => [
            'WellCart\CMS\Entity\Page'                     => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/cms:pages',
                'hydrator'               => 'WellCart\CMS\RestApi\V1\Pages\PageHydrator',
            ],
            'WellCart\CMS\RestApi\V1\Pages\PageCollection' => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/cms:pages',
                'is_collection'          => true,
            ],
        ],
    ],
    'zf-apigility'           => [
        'doctrine-connected' => [
            'WellCart\CMS\RestApi\V1\Pages\PageResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\CMS\RestApi\V1\Pages\PageHydrator',
            ],
        ],
    ],
    'doctrine-hydrator'      => [
        'WellCart\CMS\RestApi\V1\Pages\PageHydrator' => [
            'entity_class'           => 'WellCart\CMS\Spec\PageEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation'  => [
        'WellCart\CMS\RestApi\V1\Pages\Controller' => [
            'input_filter' => 'WellCart\CMS\Spec\PageEntity',
        ],
    ],
    'zf-mvc-auth'            => [
        'authentication' => [
            'map' => [
                'WellCart\CMS\Rest' => 'oauth2_doctrine',
            ],
        ],
        'authorization'  => [
            'WellCart\CMS\RestApi\V1\Pages\Controller' => [
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
