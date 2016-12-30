<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'router' => [
        'routes' => [
            'api' => [
                'child_routes' => [
                    'user:users' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'user/users[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\User\RestApi\V1\Users\Controller',
                            ],
                        ],
                    ],
                    'user:roles' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => 'user/roles[/][:id]',
                            'defaults' => [
                                'controller' => 'WellCart\User\RestApi\V1\Roles\Controller',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'zf-versioning'          => [
        'uri' => [
            'api/user:users',
            'api/user:roles',
        ],
    ],
    'zf-rest'                => [
        'WellCart\User\RestApi\V1\Users\Controller' => [
            'listener'                   => 'WellCart\User\RestApi\V1\Users\UserResource',
            'route_name'                 => 'api/user:users',
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
            'entity_class'               => 'WellCart\User\Spec\UserEntity',
            'collection_class'           => 'WellCart\User\RestApi\V1\Users\UserCollection',
            'service_name'               => 'User',
        ],
        'WellCart\User\RestApi\V1\Roles\Controller' => [
            'listener'                   => 'WellCart\User\RestApi\V1\Roles\RoleResource',
            'route_name'                 => 'api/user:roles',
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
            'entity_class'               => 'WellCart\User\Spec\AclRoleEntity',
            'collection_class'           => 'WellCart\User\RestApi\V1\Roles\RoleCollection',
            'service_name'               => 'Role',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers'            => [
            'WellCart\User\RestApi\V1\Users\Controller' => 'HalJson',
            'WellCart\User\RestApi\V1\Roles\Controller' => 'HalJson',
        ],
        'accept-whitelist'       => [
            'WellCart\User\RestApi\V1\Users\Controller' => [
                'application/hal+json',
                'application/json',
            ],
            'WellCart\User\RestApi\V1\Roles\Controller' => [
                'application/hal+json',
                'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'WellCart\User\RestApi\V1\Users\Controller' => [
                'application/json',
            ],
            'WellCart\User\RestApi\V1\Roles\Controller' => [
                'application/json',
            ],
        ],
    ],
    'zf-hal'                 => [
        'metadata_map' => [
            'WellCart\User\Entity\User'                     => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/user:users',
                'hydrator'               => 'WellCart\User\RestApi\V1\Users\UserHydrator',
            ],
            'WellCart\User\RestApi\V1\Users\UserCollection' => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/user:users',
                'is_collection'          => true,
            ],

            'WellCart\User\Spec\AclRoleEntity'              => [
                'route_identifier_name'  => 'id',
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/user:roles',
                'hydrator'               => 'WellCart\User\RestApi\V1\Roles\RoleHydrator',
            ],
            'WellCart\User\RestApi\V1\Roles\RoleCollection' => [
                'entity_identifier_name' => 'id',
                'route_name'             => 'api/user:roles',
                'is_collection'          => true,
            ],
        ],
    ],
    'zf-apigility'           => [
        'doctrine-connected' => [
            'WellCart\User\RestApi\V1\Users\UserResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\User\RestApi\V1\Users\UserHydrator',
            ],
            'WellCart\User\RestApi\V1\Roles\RoleResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator'       => 'WellCart\User\RestApi\V1\Roles\RoleHydrator',
            ],
        ],
    ],
    'doctrine-hydrator'      => [
        'WellCart\User\RestApi\V1\Users\UserHydrator' => [
            'entity_class'           => 'WellCart\User\Spec\UserEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
        'WellCart\User\RestApi\V1\Roles\RoleHydrator' => [
            'entity_class'           => 'WellCart\User\Spec\AclRoleEntity',
            'object_manager'         => 'doctrine.entitymanager.orm_default',
            'by_value'               => true,
            'naming_strategy'        => 'UnderscoreNamingStrategy',
            'strategies'             => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation'  => [
        'WellCart\User\RestApi\V1\Users\Controller' => [
            'input_filter' => 'WellCart\User\Spec\UserEntity',
        ],
        'WellCart\User\RestApi\V1\Roles\Controller' => [
            'input_filter' => 'WellCart\User\Spec\AclRoleEntity',
        ],
    ],
    'zf-mvc-auth'            => [
        'authentication' => [
            'map' => [
                'WellCart\User\Rest' => 'oauth2_doctrine',
            ],
        ],
        'authorization'  => [
            'WellCart\User\RestApi\V1\Users\Controller' => [
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
            'WellCart\User\RestApi\V1\Roles\Controller' => [
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
