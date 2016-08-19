<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'wellcart-base:url-rewrites'        => [
        'type'     => 'SystemUrlRewritesHandler',
        'priority' => 100000,
    ],
    'assets'                            => [
        'type'             => 'WellCart\Router\Http\Literal',
        'javascript_route' => true,
        'priority'         => -500,
        'options'          => [
            'route'    => '/assets/',
            'defaults' => [
                'controller' => 'WellCart\Base\Controller\Index',
                'action'     => 'index',
            ],
        ],
    ],
    'wellcart-base:home'                => [
        'type'             => 'WellCart\Router\Http\Literal',
        'javascript_route' => true,
        'priority'         => -500,
        'options'          => [
            'route'    => '/',
            'defaults' => [
                'controller' => 'WellCart\Base\Controller\Index',
                'action'     => 'index',
            ],
        ],
    ],
    'zfcadmin'                          => [
        'type'          => 'WellCart\Router\Http\Segment',
        'may_terminate' => true,
        'options'       => [
            'route'    => '/admin[/]',
            'defaults' => [
                'controller' => 'WellCart\Base\Controller\Index',
                'action'     => 'not-found',
            ],
        ],
        'child_routes'  => [
            'base' => [
                'type'         => 'WellCart\Router\Http\Literal',
                'priority'     => -500,
                'options'      => [
                    'route'    => 'base/',
                    'defaults' => [
                        'controller' => 'WellCart\Base\Controller\Admin\Languages',
                        'action'     => 'list',
                    ],
                ],
                'child_routes' => [
                    'languages'    => [
                        'type'             => 'WellCart\Router\Http\Segment',
                        'javascript_route' => true,
                        'priority'         => -500,
                        'options'          => [
                            'route'       => 'languages[/:action][/][:id]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '(list|update|create|delete|group-action-handler)',
                                'id'         => '([0-9]+|delete)',
                            ],
                            'defaults'    => [
                                'controller' => 'WellCart\Base\Controller\Admin\Languages',
                                'action'     => 'list',
                                'id'         => null,
                            ],
                        ],
                    ],
                    'url-rewrites' => [
                        'type'             => 'WellCart\Router\Http\Segment',
                        'javascript_route' => true,
                        'priority'         => -500,
                        'options'          => [
                            'route'       => 'url-rewrites[/:action][/][:id]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '(list|update|create|delete|group-action-handler)',
                                'id'         => '([0-9]+|delete)',
                            ],
                            'defaults'    => [
                                'controller' => 'WellCart\Base\Controller\Admin\UrlRewrites',
                                'action'     => 'list',
                                'id'         => null,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'wellcart-base:image-service-cache' => [
        'type'    => 'Zend\Mvc\Router\Http\Regex',
        'options' => [
            'regex'    => '/media/(?<module>[a-zA-Z0-9_-]+)/(?<entity>[a-zA-Z0-9_-]+)/(?<filter_name>[a-zA-Z0-9_-]+)/(?<theme>[a-zA-Z0-9_-]+)_(?<width>[0-9]+)x(?<height>[0-9]+)/(?<image>[\s\S]+)',
            'defaults' => [
                'controller' => 'WellCart\Base\Controller\ImageService',
                'action'     => 'image',
            ],
            'spec'     => '/media/%module%/%entity%/%filter_name%/%theme%_%width%x%height%/%image%',
        ],
    ],
    'htimg'                             => [
        'type'          => 'Literal',
        'options'       => [
            'route'    => '/htimg',
            'defaults' => [
                'controller' => 'WellCart\Base\Controller\Index',
                'action'     => 'not-found'
            ],
        ],
        'may_terminate' => true,
        'child_routes'  => [
            'display' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/display/:filter[/]',
                    'defaults' => [
                        'controller' => 'WellCart\Base\Controller\Index',
                        'action'     => 'not-found'
                    ],
                ],
            ],
        ]
    ]
];
