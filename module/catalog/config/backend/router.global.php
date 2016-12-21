<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog;
/**
 * =========================================================
 * Router configuration
 * =========================================================
 */
return [
    'router'                     => [
        'routes' => [
            'zfcadmin' => [
                'child_routes' => [
                    'catalog' => [
                        'type'         => 'WellCart\Router\Http\Literal',
                        'priority'     => -500,
                        'options'      => [
                            'route'    => 'catalog/',
                            'defaults' => [
                                'controller' => 'Catalog::Backend\Products',
                                'action'     => 'list',
                            ],
                        ],
                        'child_routes' => [
                            'products'   => [
                                'type'             => \WellCart\Router\Http\Segment::class,
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'products[/:action][/][:id][/:template]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|variants|group-action-handler)',
                                        'id'         => '([0-9]+)',
                                        'template'   => '([0-9]+)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'Catalog::Backend\Products',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'categories' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'categories[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteCategories)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'Catalog::Backend\Categories',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'features'   => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'options'          => [
                                    'route'       => 'features[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete)',
                                        'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'Catalog::Backend\Features',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],

                            'product-templates' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'options'          => [
                                    'route'       => 'product-templates[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteProductTemplates)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'Catalog::Backend\ProductTemplates',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],

                            'attributes' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'options'          => [
                                    'route'       => 'attributes[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteAttributes)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'Catalog::Backend\Attributes',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],

                            'brands' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'options'          => [
                                    'route'       => 'brands[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete)',
                                        'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'Catalog::Backend\Brands',
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
];
