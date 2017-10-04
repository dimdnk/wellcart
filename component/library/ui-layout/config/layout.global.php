<?php

use WellCart\Ui\Layout\Generator\BlocksGenerator;
use WellCart\Ui\Layout\Generator\ViewHelperGenerator;
use WellCart\Ui\Layout\Updater\Collector\FilesystemCollector;
use WellCart\Ui\Layout\Updater\Collector\ConfigCollector;
use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use WellCart\Ui\Layout\View\Helper\Proxy\HeadLinkProxy;
use WellCart\Ui\Layout\View\Helper\Proxy\HeadMetaProxy;
use WellCart\Ui\Layout\View\Helper\Proxy\HeadScriptProxy;
use WellCart\Ui\Layout\View\Helper\Proxy\HeadTitleProxy;
use WellCart\Ui\Layout\View\Helper\Proxy\InlineScriptProxy;
use Zend\View\Model\ViewModel;

return [
  'wellcart' => [
    'layout' => [
        'debug' => false,
        /**
         * paths where to search for layout updates
         *
         * @see docs/areas.md
         *
         * format & examples: [
         *      'global' => [
         *          './themes/my-theme/layout/global'
         *      ],
         *      'frontend' => [
         *          './themes/my-theme/layout/frontend'
         *      ],
         *      'backend' => [
         *          ./'themes/admin-theme/layout',
         *          __DIR__ . '/../layout/backend' // in a module.config.php
         *      ]
         *  ]
         */
        'layout_update_paths' => [
            LayoutUpdaterInterface::AREA_GLOBAL => []
        ],
        /**
         * allowed config types
         *
         * you can explicitly disable an extension by setting its value to false
         *
         *  'layout_update_extensions' => [
         *      'xml' => false,
         *      'php',
         *      'yaml'
         *  ]
         *
         * @see http://framework.zend.com/manual/current/en/modules/zend.config.reader.html
         */
        'layout_update_extensions' => [
            'xml'
        ],
        'default_area' => LayoutUpdaterInterface::AREA_DEFAULT,
        /**
         * Array of controller namespace -> action handle mappings. Assuming that the setting
         * 'prefer_route_match_controller' is set to 'false' and the controller fully qualified
         * class name is 'FooBar\Controller\IndexController::test'.
         *
         *  'controller_map' => [
         *      'FooBar' => 'custom-handle'
         *  ]
         *
         * The action handles injected would be:
         *
         *  'default'
         *  'custom-handle'
         *  'custom-handle/index'
         *  'custom-handle/index/test'
         *
         * Instead of:
         *
         *  'default'
         *  'foo-bar'
         *  'foo-bar/index'
         *  'foo-bar/index/test'
         */
        'controller_map' => [

        ],
        /**
         * Whether to force the use of the route match controller param.
         */
        'prefer_route_match_controller' => true,
        /**
         * base dir to assets
         *
         * is used by WellCart\Ui\Layout\Filter\CacheBuster to read the file
         * and appends an md5 query string so that browsers always pull the
         * latest asset from the server
         */
        'cache_buster_internal_base_dir' => './public',
        /**
         * block defaults
         */
        'block_defaults' => [
            'capture_to' => 'content',
            'append'     => true,
            'class'      => ViewModel::class,
            'options'    => [],
            'variables'  => [],
            'template'   => '',
            'actions'    => []
        ],
        /**
         * defaults for view_helpers-instructions
         */
        'view_helpers' => [
            'doctype' => [
                'default_param' => 'doctype'
            ],
            'headLink' => [
                'method' => 'appendStylesheet',
                'debug'  => 'extras',
                'filter' => [
                    'href' => [
                        'basePath' => 5,
                        'cacheBuster' => 10
                    ]
                ],
                'proxy' => HeadLinkProxy::class
            ],
            'headScript' => [
                'method' => 'appendFile',
                'debug'  => 'attrs',
                'filter' => [
                    'src' => [
                        'basePath' => 5,
                        'cacheBuster' => 10
                    ]
                ],
                'proxy' => HeadScriptProxy::class
            ],
            'inlineScript' => [
                'method' => 'appendFile',
                'debug'  => 'attrs',
                'filter' => [
                    'src' => [
                        'basePath' => 5,
                        'cacheBuster' => 10
                    ]
                ],
                'proxy' => InlineScriptProxy::class
            ],
            'headTitle' => [
                'method' => 'append',
                'proxy' => HeadTitleProxy::class
            ],
            'headMeta' => [
                'method' => 'setName',
                'debug' => 'modifiers',
                'proxy' => HeadMetaProxy::class
            ],
            'bodyClass' => [
                'method' => 'addClass'
            ]
        ],
        'generators' => [
            BlocksGenerator::NAME => [
                'class' => BlocksGenerator::class,
                'priority' => 1
            ],
            ViewHelperGenerator::NAME => [
                'class' => ViewHelperGenerator::class,
                'priority' => 1
            ]
        ],
        'collectors' => [
            ConfigCollector::NAME => [
                'class' => ConfigCollector::class,
                'priority' => 20
            ],
            FilesystemCollector::NAME => [
                'class' => FilesystemCollector::class,
                'priority' => 10
            ]
        ]
        /**
         * enable/disable particular listeners
         */
        /*
        'listeners' => [
            'WellCart\Ui\Layout\EventListener\ActionHandlesListener'  => true,
            'WellCart\Ui\Layout\EventListener\LoadLayoutListener'     => true,
            'WellCart\Ui\Layout\EventListener\PrepareActionViewModelListener' => true
        ]*/
    ]
  ]
 ];
