<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'router'                 => [
        'routes' => [
            'api' => [
                'child_routes' => [
                    'catalog:brands'     => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'catalog/brands[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Catalog\RestApi\V1\Brands\Controller',
                            ],
                        ],
                    ],
                    'catalog:categories' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'catalog/categories[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Catalog\RestApi\V1\Categories\Controller',
                            ],
                        ],
                    ],
                    'catalog:products'   => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'catalog/products[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Catalog\RestApi\V1\Products\Controller',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'zf-versioning'          => [
        'uri' => [
            'api/catalog:brands',
            'api/catalog:products',
            'api/catalog:categories',
        ],
    ],
    'zf-rest'                => [
        'WellCart\Catalog\RestApi\V1\Brands\Controller'     => [
            'listener'                   => 'WellCart\Catalog\RestApi\V1\Brands\BrandResource',
            'route_name'                 => 'api/catalog:brands',
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
            'entity_class'               => 'WellCart\Catalog\Spec\BrandEntity',
            'collection_class'           => 'WellCart\Catalog\RestApi\V1\Brands\BrandCollection',
            'service_name'               => 'Brand',
        ],
        'WellCart\Catalog\RestApi\V1\Products\Controller'   => [
            'listener'                   => 'WellCart\Catalog\RestApi\V1\Products\ProductResource',
            'route_name'                 => 'api/catalog:products',
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
            'entity_class'               => 'WellCart\Catalog\Spec\ProductEntity',
            'collection_class'           => 'WellCart\Catalog\RestApi\V1\Products\ProductCollection',
            'service_name'               => 'Product',
        ],

        'WellCart\Catalog\RestApi\V1\Categories\Controller' => [
            'listener'                   => 'WellCart\Catalog\RestApi\V1\Categories\CategoryResource',
            'route_name'                 => 'api/catalog:categories',
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
            'entity_class'               => 'WellCart\Catalog\Spec\CategoryEntity',
            'collection_class'           => 'WellCart\Catalog\RestApi\V1\Categories\CategoryCollection',
            'service_name'               => 'Category',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers'            => [
            'WellCart\Catalog\RestApi\V1\Brands\Controller'     => 'HalJson',
            'WellCart\Catalog\RestApi\V1\Categories\Controller' => 'HalJson',
            'WellCart\Catalog\RestApi\V1\Products\Controller'   => 'HalJson',
        ],
        'accept-whitelist'       => [
            'WellCart\Catalog\RestApi\V1\Brands\Controller'     => [
                'application/hal+json',
                'application/json',
            ],
            'WellCart\Catalog\RestApi\V1\Products\Controller'   => [
                'application/hal+json',
                'application/json',
            ],
            'WellCart\Catalog\RestApi\V1\Categories\Controller' => [
                'application/hal+json',
                'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'WellCart\Catalog\RestApi\V1\Brands\Controller'     => [
                'application/json',
            ],
            'WellCart\Catalog\RestApi\V1\Products\Controller'   => [
                'application/json',
            ],
            'WellCart\Catalog\RestApi\V1\Categories\Controller' => [
                'application/json',
            ],
        ],
    ],
    'zf-hal'                 => [
        'metadata_map' => [
            'WellCart\Catalog\Entity\Brand'                             => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/catalog:brands',
                'hydrator'               => 'WellCart\Catalog\RestApi\V1\Brands\BrandHydrator',
            ],
            'WellCart\Catalog\RestApi\V1\Brands\BrandCollection'        => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/catalog:brands',
                'is_collection'          => true,
            ],

            'WellCart\Catalog\Entity\Product'                           => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/catalog:products',
                'hydrator'               => 'WellCart\Catalog\RestApi\V1\Products\ProductHydrator',
            ],
            'WellCart\Catalog\RestApi\V1\Products\ProductCollection'    => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/catalog:products',
                'is_collection'          => true,
            ],


            'WellCart\Catalog\Entity\Category'                          => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/catalog:categories',
                'hydrator'               => 'WellCart\Catalog\RestApi\V1\Categories\CategoryHydrator',
            ],
            'WellCart\Catalog\RestApi\V1\Categories\CategoryCollection' => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/catalog:categories',
                'is_collection'          => true,
            ],
        ],
    ],
    'zf-apigility'           => [
        'doctrine-connected' => [
            'WellCart\Catalog\RestApi\V1\Brands\BrandResource'        => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Catalog\RestApi\V1\Brands\BrandHydrator',
            ],
            'WellCart\Catalog\RestApi\V1\Products\ProductResource'    => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Catalog\RestApi\V1\Products\ProductHydrator',
            ],

            'WellCart\Catalog\RestApi\V1\Categories\CategoryResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Catalog\RestApi\V1\Categories\CategoryHydrator',
            ],
        ],
    ],
    'doctrine-hydrator'      => [
        'WellCart\Catalog\RestApi\V1\Brands\BrandHydrator'        => [
            'entity_class'           => 'WellCart\Catalog\Spec\BrandEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
        'WellCart\Catalog\RestApi\V1\Products\ProductHydrator'    => [
            'entity_class'           => 'WellCart\Catalog\Spec\ProductEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
        'WellCart\Catalog\RestApi\V1\Categories\CategoryHydrator' => [
            'entity_class'           => 'WellCart\Catalog\Spec\CategoryEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation'  => [
        'WellCart\Catalog\RestApi\V1\Brands\Controller'     => [
            'input_filter' => 'WellCart\Catalog\Spec\BrandEntity',
        ],
        'WellCart\Catalog\RestApi\V1\Products\Controller'   => [
            'input_filter' => 'WellCart\Catalog\Spec\ProductEntity',
        ],
        'WellCart\Catalog\RestApi\V1\Categories\Controller' => [
            'input_filter' => 'WellCart\Catalog\Spec\CategoryEntity',
        ],
    ],
    'zf-mvc-auth'            => [
        'authentication' => [
            'map' => [
                'WellCart\Catalog\Rest' => 'oauth2_doctrine',
            ],
        ],
        'authorization'  => [
            'WellCart\Catalog\RestApi\V1\Brands\Controller'     => [
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
            'WellCart\Catalog\RestApi\V1\Products\Controller'   => [
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
            'WellCart\Catalog\RestApi\V1\Categories\Controller' => [
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
