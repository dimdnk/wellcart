<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'aggregates' => [],
    'listeners'  => [
        'WellCart\Admin\EventListener\RemoveConfigCacheFile' => [
            'id'       => 'WellCart\Base\Service\ConfigurationEditor',
            'event'    => 'saveConfigSet.post',
            'listener' => 'WellCart\Admin\EventListener\RemoveConfigCacheFile',
            'priority' => -100,
        ],
    ],
];
