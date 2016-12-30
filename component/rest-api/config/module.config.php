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
                    __DIR__ => __DIR__ . '/common/mapping/',
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
                    'Api::OAuth2\AccessToken'       => Entity\OAuth2\AccessToken::class,
                    'Api::OAuth2\AuthorizationCode' => Entity\OAuth2\AuthorizationCode::class,
                    'Api::OAuth2\Client'            => Entity\OAuth2\Client::class,
                    'Api::OAuth2\Jti'               => Entity\OAuth2\Jti::class,
                    'Api::OAuth2\Jwt'               => Entity\OAuth2\Jwt::class,
                    'Api::OAuth2\PublicKey'         => Entity\OAuth2\PublicKey::class,
                    'Api::OAuth2\RefreshToken'      => Entity\OAuth2\RefreshToken::class,
                    'Api::OAuth2\Scope'             => Entity\OAuth2\Scope::class,
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
            'RestApi::Hello'                     => Controller\HelloController::class,
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
];
