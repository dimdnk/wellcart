<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'wellcart-base:url-rewrites' => [
        'type'     => 'SystemUrlRewritesHandler',
        'priority' => 100000,
    ],
    'assets'                     => [
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
    'wellcart-base:home'         => [
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
    'zfcadmin'                   => [
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
    'tckimageresizer'            => array(
        'type'          => 'Literal',
        'options'       => array(
            'route'    => '/media',
            'defaults' => array(
                '__NAMESPACE__' => null,
                'controller'    => 'TckImageResizer\Controller\Index',
                'action'        => 'index',
            ),
        ),
        'may_terminate' => true,
        'child_routes'  => array(
            'resize' => array(
                'type'    => 'Zend\Mvc\Router\Http\Regex',
                'options' => array(
                    'regex'    => '/(?<file>.*?)\.\$(?<command>.*)\.(?<extension>[a-zA-Z]+)',
                    'defaults' => array(
                        'controller' => 'TckImageResizer\Controller\Index',
                        'action'     => 'resize',
                    ),
                    'spec'     => '/media/%file%.$%command%.%extension%',
                ),
            ),
        ),
    ),
];
