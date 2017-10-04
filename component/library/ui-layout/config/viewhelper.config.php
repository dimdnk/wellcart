<?php

use WellCart\Ui\Layout\View\Helper\Block;
use WellCart\Ui\Layout\View\Helper\BlockFactory;
use WellCart\Ui\Layout\View\Helper\BodyClass;
use WellCart\Ui\Layout\View\Helper\Proxy\ViewHelperProxyAbstractFactory;
use WellCart\Ui\Layout\View\Helper\Wrapper;

return [
    'invokables' => [
        Wrapper::class   => Wrapper::class,
        BodyClass::class => BodyClass::class
    ],
    'factories' => [
        Block::class => BlockFactory::class
    ],
    'aliases' => [
        'bodyClass' => BodyClass::class,
        'block'     => Block::class,
        'wrapper'   => Wrapper::class
    ],
    'abstract_factories' => [
        ViewHelperProxyAbstractFactory::class
    ]
];
