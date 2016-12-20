<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\RestApi;

return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager' => [
        'invokables' => [],

        'aliases'            => [
            'wellcart_api_db_adapter'        => 'Zend\Db\Adapter\Adapter',
            'wellcart_api_object_manager'    => 'Doctrine\ORM\EntityManager',
            'wellcart_api_doctrine_hydrator' => 'doctrine_hydrator',
        ],
        'factories'          => [],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            PageView\Backend\OAuth2\PublicKeysGrid::class => false,
            PageView\Backend\OAuth2\PublicKeyForm::class  => false,
            PageView\Backend\OAuth2\ClientsGrid::class    => false,
            PageView\Backend\OAuth2\ClientForm::class     => false,
            PageView\Backend\OAuth2\ScopesGrid::class     => false,
            PageView\Backend\OAuth2\ScopeForm::class      => false,
        ],
    ],

    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'        => [
        'driver'          => [
            'wellcart_api_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ => __DIR__ . '/mapping/',
                ],
            ],
            // default metadata driver, aggregates all other drivers into a single one.
            'orm_default'         => [
                'drivers' => [
                    'WellCart\RestApi\Entity' => 'wellcart_api_driver',
                ]
            ]
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    'Api::OAuth2\AccessToken'       => 'WellCart\RestApi\Entity\OAuth2\AccessToken',
                    'Api::OAuth2\AuthorizationCode' => 'WellCart\RestApi\Entity\OAuth2\AuthorizationCode',
                    'Api::OAuth2\Client'            => 'WellCart\RestApi\Entity\OAuth2\Client',
                    'Api::OAuth2\Jti'               => 'WellCart\RestApi\Entity\OAuth2\Jti',
                    'Api::OAuth2\Jwt'               => 'WellCart\RestApi\Entity\OAuth2\Jwt',
                    'Api::OAuth2\PublicKey'         => 'WellCart\RestApi\Entity\OAuth2\PublicKey',
                    'Api::OAuth2\RefreshToken'      => 'WellCart\RestApi\Entity\OAuth2\RefreshToken',
                    'Api::OAuth2\Scope'             => 'WellCart\RestApi\Entity\OAuth2\Scope',
                ],
            ],
        ],
    ],
    /**
     * =========================================================
     * Translator configuration
     * =========================================================
     */
    'translator'      => [
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
     * Router configuration
     * =========================================================
     */
    'router'          => [
        'routes' => [
            'oauth'    => [
                'type'          => 'Zend\Mvc\Router\Http\Literal',
                'options'       => [
                    'route'    => '/api/oauth',
                    'defaults' => [
                        'controller' => 'ZF\OAuth2\Controller\Auth',
                        'action'     => 'token',
                    ],
                ],
                'may_terminate' => true,
            ],
            'api'      => [
                'type'          => 'WellCart\Router\Http\Segment',
                'priority'      => -500,
                'options'       => [
                    'route'    => '/api[/]',
                    'defaults' => [
                        'controller' => 'RestApi::Hello',
                    ],
                ],
                'child_routes'  => [],
                'may_terminate' => true,
            ],
            'zfcadmin' => [
                'child_routes' => [
                    'api' => [
                        'type'         => 'WellCart\Router\Http\Literal',
                        'priority'     => -500,
                        'options'      => [
                            'route'    => 'api/',
                            'defaults' => [
                                'controller' => 'RestApi::Backend\OAuth2\Clients',
                                'action'     => 'list',
                            ],
                        ],
                        'child_routes' => [
                            'oauth2-clients'     => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'oauth2-clients[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteClients|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'RestApi::Backend\OAuth2\Clients',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'oauth2-scopes'      => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'oauth2-scopes[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteScopes|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'RestApi::Backend\OAuth2\Scopes',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'oauth2-public-keys' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'oauth2-public-keys[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteKeys|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'RestApi::Backend\OAuth2\PublicKeys',
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
    'controllers'     => [
        'aliases'    => [
            'RestApi::Hello'                   => Controller\HelloController::class,
            'RestApi::Backend\OAuth2\PublicKeys' => Controller\Backend\OAuth2\PublicKeysController::class,
            'RestApi::Backend\OAuth2\Clients'    => Controller\Backend\OAuth2\ClientsController::class,
            'RestApi::Backend\OAuth2\Scopes'     => Controller\Backend\OAuth2\ScopesController::class,
        ],
        'invokables' => [
            Controller\HelloController::class => Controller\HelloController::class,
        ],
        'factories'  => [
            Controller\Backend\OAuth2\PublicKeysController::class => Factory\Controller\Backend\OAuth2\PublicKeysControllerFactory::class,
            Controller\Backend\OAuth2\ClientsController::class    => Factory\Controller\Backend\OAuth2\ClientsControllerFactory::class,
            Controller\Backend\OAuth2\ScopesController::class     => Factory\Controller\Backend\OAuth2\ScopesControllerFactory::class,
        ],
    ],

    'form_elements' => [
        'factories' => [
            'apiClientSelector' => Factory\FormElement\ApiClientSelectorFactory::class,
        ],
    ],

    'zf-versioning'      => [
        'uri' => [],
    ],
    'object_mapping'     => include __DIR__ . '/object_mapping.php',
    'zf-oauth2-doctrine' => include __DIR__ . '/zfoauth2doctrine.php',
    'zf-mvc-auth'        => [
        'authentication' => [
            'adapters' => [
                'oauth2_doctrine' => [
                    'adapter' => 'ZF\\MvcAuth\\Authentication\\OAuth2Adapter',
                    'storage' => [
                        'storage' => 'oauth2.doctrineadapter.default',
                        'route'   => '/api/oauth',
                    ],
                ],
            ],
        ],
    ],
    'zf-oauth2'          => [
        'allow_implicit'  => true,
        // default (set to true when you need to support browser-based or mobile apps)
        'access_lifetime' => 3600,
        // default (set a value in seconds for access tokens lifetime)
        'enforce_state'   => true,  // default
        'storage'         => 'oauth2.doctrineadapter.default',
    ],
];
