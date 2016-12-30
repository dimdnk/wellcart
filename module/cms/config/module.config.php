<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\CMS;

return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager' => [
        'invokables'         => [],
        'aliases'            => [
            'wellcart_cms_db_adapter'        => 'Zend\Db\Adapter\Adapter',
            'wellcart_cms_object_manager'    => 'Doctrine\ORM\EntityManager',
            'wellcart_cms_doctrine_hydrator' => 'doctrine_hydrator',
            Spec\PageRepository::class       => Repository\Pages::class,
            Spec\PageI18nRepository::class   => Repository\PageI18n::class,
        ],
        'factories'          => [],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            PageView\Backend\PagesGrid::class => false,
            PageView\Backend\PageForm::class  => false,
        ],
    ],

    'controllers'   => [
        'aliases'   => [
            'CMS::Backend\Pages' => Controller\Backend\PagesController::class,
        ],
        'factories' => [
            Controller\Backend\PagesController::class => Factory\Controller\Backend\PagesControllerFactory::class,
        ],
    ],

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'        => [
        'routes' => [
            'zfcadmin' => [
                'child_routes' => [
                    'cms' => [
                        'type'         => 'WellCart\Router\Http\Literal',
                        'priority'     => -500,
                        'options'      => [
                            'route'    => 'cms/',
                            'defaults' => [
                                'controller' => 'CMS::Backend\Pages',
                                'action'     => 'list',
                            ],
                        ],
                        'child_routes' => [
                            'pages' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'pages[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deletePages|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'CMS::Backend\Pages',
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


    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'      => [
        'driver'          => [
            'wellcart_cms_driver' => [
                'class' => 'WellCart\ORM\Mapping\Driver\SystemConfigDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ => __DIR__ . '/../src/Entity/',
                ],
            ],
            // default metadata driver, aggregates all other drivers into a single one.
            'orm_default'         => [
                'drivers' => [
                    'WellCart\CMS\Entity' => 'wellcart_cms_driver',
                ]
            ]
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    Spec\PageEntity::class     => Entity\Page::class,
                    Spec\PageI18nEntity::class => Entity\PageI18n::class,
                    'CMS::Page'                => Entity\Page::class,
                    'CMS::PageI18n'            => Entity\PageI18n::class,
                ],
            ],
        ],
    ],
    /**
     * =========================================================
     * Static assets configuration
     * =========================================================
     */
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ => __DIR__ . '/../public/',
            ],
        ],
    ],

    /**
     * =========================================================
     * Translator configuration
     * =========================================================
     */
    'translator'    => [
        'translation_file_patterns' => [
            __FILE__ => [
                'text_domain' => 'default',
                'type'        => 'gettext',
                'base_dir'    => __DIR__ . '/../language',
                'pattern'     => '%s.mo',
            ],
        ],
    ],
];
