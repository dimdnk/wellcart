<?php

use WellCart\Ui\Layout\Controller\Plugin\LayoutManagerFactory;
use WellCart\Ui\Layout\Zdt\Collector\LayoutCollector;
use WellCart\Ui\Layout\Block\Container;

return [
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'template_map' => [
            'zend-developer-tools/toolbar/wellcart-ui-layout' => __DIR__ . '/../view/zend-developer-tools/toolbar/layout.phtml',
        ],
        'layout' => ''
    ],
    'controller_plugins' => [
        'factories' => [
            'layoutManager' => LayoutManagerFactory::class
        ]
    ],
    'zenddevelopertools' => [
        'profiler' => [
            'collectors' => [
                'wellcart-ui-layout' => LayoutCollector::class,
            ],
        ],
        'toolbar' => [
            'entries' => [
                'wellcart-ui-layout' => 'zend-developer-tools/toolbar/wellcart-ui-layout',
            ],
        ],
    ],
    'blocks' => [
        'invokables' => [
            'container' => Container::class
        ],
        'shared' => [
            'container' => false
        ]
    ]
];
