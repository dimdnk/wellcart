<?php

use WellCart\Ui\Layout\Filter\BasePathFilter;
use WellCart\Ui\Layout\Filter\BasePathFilterFactory;
use WellCart\Ui\Layout\Filter\CacheBusterFilter;
use WellCart\Ui\Layout\Filter\CacheBusterFilterFactory;
use WellCart\Ui\Layout\Filter\TranslateFilter;
use WellCart\Ui\Layout\Filter\TranslateFilterFactory;
use WellCart\Ui\Layout\Filter\DebugFilter;
use WellCart\Ui\Layout\Filter\DebugFilterFactory;

return [
    'factories' => [
        BasePathFilter::class => BasePathFilterFactory::class,
        TranslateFilter::class => TranslateFilterFactory::class,
        CacheBusterFilter::class => CacheBusterFilterFactory::class,
        DebugFilter::class => DebugFilterFactory::class
    ],
    'aliases' => [
        'basePath' => BasePathFilter::class,
        'translate' => TranslateFilter::class,
        'cacheBuster' => CacheBusterFilter::class
    ]
];
