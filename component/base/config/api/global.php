<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'router' => [
        'routes' => [
            'api' => [
                'child_routes' => [
                    'base:configuration'    => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'base/configuration[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Base\RestApi\V1\Configuration\Controller',
                            ],
                        ],
                    ],
                    'base:url-rewrites'     => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'base/url-rewrites[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Base\RestApi\V1\UrlRewrites\Controller',
                            ],
                        ],
                    ],
                    'base:locale-languages' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'base/locale-languages[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\Base\RestApi\V1\LocaleLanguages\Controller',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'zf-versioning'          => [
        'uri' => [
            'api/base:configuration',
            'api/base:url-rewrites',
            'api/base:locale-languages',
        ],
    ],
    'zf-rest'                => [
        'WellCart\Base\RestApi\V1\Configuration\Controller' => [
            'listener'                   => 'WellCart\Base\RestApi\V1\Configuration\ConfigurationResource',
            'route_name'                 => 'api/base:configuration',
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
            'entity_class'               => 'WellCart\Base\Spec\ConfigurationEntity',
            'collection_class'           => 'WellCart\Base\RestApi\V1\Configuration\ConfigurationCollection',
            'service_name'               => 'Configuration',
        ],


        'WellCart\Base\RestApi\V1\UrlRewrites\Controller' => [
            'listener'                   => 'WellCart\Base\RestApi\V1\UrlRewrites\UrlRewriteResource',
            'route_name'                 => 'api/base:url-rewrites',
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
            'entity_class'               => 'WellCart\Base\Spec\UrlRewriteEntity',
            'collection_class'           => 'WellCart\Base\RestApi\V1\UrlRewrites\UrlRewriteCollection',
            'service_name'               => 'UrlRewrite',
        ],

        'WellCart\Base\RestApi\V1\LocaleLanguages\Controller' => [
            'listener'                   => 'WellCart\Base\RestApi\V1\LocaleLanguages\LocaleLanguageResource',
            'route_name'                 => 'api/base:locale-languages',
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
            'entity_class'               => 'WellCart\Base\Spec\LocaleLanguageEntity',
            'collection_class'           => 'WellCart\Base\RestApi\V1\LocaleLanguages\LocaleLanguageCollection',
            'service_name'               => 'LocaleLanguage',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers'            => [
            'WellCart\Base\RestApi\V1\Configuration\Controller'   => 'HalJson',
            'WellCart\Base\RestApi\V1\UrlRewrites\Controller'     => 'HalJson',
            'WellCart\Base\RestApi\V1\LocaleLanguages\Controller' => 'HalJson',
        ],
        'accept-whitelist'       => [
            'WellCart\Base\RestApi\V1\Configuration\Controller'   => [
                'application/hal+json',
                'application/json',
            ],
            'WellCart\Base\RestApi\V1\UrlRewrites\Controller'     => [
                'application/hal+json',
                'application/json',
            ],
            'WellCart\Base\RestApi\V1\LocaleLanguages\Controller' => [
                'application/hal+json',
                'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'WellCart\Base\RestApi\V1\Configuration\Controller'   => [
                'application/json',
            ],
            'WellCart\Base\RestApi\V1\UrlRewrites\Controller'     => [
                'application/json',
            ],
            'WellCart\Base\RestApi\V1\LocaleLanguages\Controller' => [
                'application/json',
            ],
        ],
    ],
    'zf-hal'                 => [
        'metadata_map' => [
            'WellCart\Base\Entity\Configuration'                             => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/base:configuration',
                'hydrator'               => 'WellCart\Base\RestApi\V1\Configuration\ConfigurationHydrator',
            ],
            'WellCart\Base\RestApi\V1\Configuration\ConfigurationCollection' => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/base:configuration',
                'is_collection'          => true,
            ],

            'WellCart\Base\Entity\Locale\Language'                              => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/base:locale-languages',
                'hydrator'               => 'WellCart\Base\RestApi\V1\LocaleLanguages\LocaleLanguageHydrator',
            ],
            'WellCart\Base\RestApi\V1\LocaleLanguages\LocaleLanguageCollection' => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/base:locale-languages',
                'is_collection'          => true,
            ],

            'WellCart\Base\Entity\UrlRewrite'                           => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/base:url-rewrites',
                'hydrator'               => 'WellCart\Base\RestApi\V1\UrlRewrites\UrlRewriteHydrator',
            ],
            'WellCart\Base\RestApi\V1\UrlRewrites\UrlRewriteCollection' => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/base:url-rewrites',
                'is_collection'          => true,
            ],
        ],
    ],
    'zf-apigility'           => [
        'doctrine-connected' => [
            'WellCart\Base\RestApi\V1\Configuration\ConfigurationResource'    => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Base\RestApi\V1\Configuration\ConfigurationHydrator',
            ],
            'WellCart\Base\RestApi\V1\UrlRewrites\UrlRewriteResource'         => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Base\RestApi\V1\UrlRewrites\UrlRewriteHydrator',
            ],
            'WellCart\Base\RestApi\V1\LocaleLanguages\LocaleLanguageResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\Base\RestApi\V1\LocaleLanguages\LocaleLanguageHydrator',
            ],
        ],
    ],
    'doctrine-hydrator'      => [
        'WellCart\Base\RestApi\V1\Configuration\ConfigurationHydrator'    => [
            'entity_class'           => 'WellCart\Base\Spec\ConfigurationEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
        'WellCart\Base\RestApi\V1\UrlRewrites\UrlRewriteHydrator'         => [
            'entity_class'           => 'WellCart\Base\Spec\UrlRewriteEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
        'WellCart\Base\RestApi\V1\LocaleLanguages\LocaleLanguageHydrator' => [
            'entity_class'           => 'WellCart\Base\Spec\LocaleLanguageEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation'  => [
        'WellCart\Base\RestApi\V1\Configuration\Controller'   => [
            'input_filter' => 'WellCart\Base\Spec\ConfigurationEntity',
        ],
        'WellCart\Base\RestApi\V1\UrlRewrites\Controller'     => [
            'input_filter' => 'WellCart\Base\Spec\UrlRewriteEntity',
        ],
        'WellCart\Base\RestApi\V1\LocaleLanguages\Controller' => [
            'input_filter' => 'WellCart\Base\Spec\LocaleLanguageEntity',
        ],
    ],
    'zf-mvc-auth'            => [
        'authentication' => [
            'map' => [
                'WellCart\Base\Rest' => 'oauth2_doctrine',
            ],
        ],
        'authorization'  => [
            'WellCart\Base\RestApi\V1\Configuration\Controller'   => [
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
            'WellCart\Base\RestApi\V1\UrlRewrites\Controller'     => [
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
            'WellCart\Base\RestApi\V1\LocaleLanguages\Controller' => [
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
