<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Backend;

use WellCart\Base\Service\ConfigurationEditor;

return [
    'event_manager' => [
        'aggregates' => [],
        'listeners'  => [
            EventListener\Config\RemoveConfigCacheFile::class => [
                'id'       => ConfigurationEditor::class,
                'event'    => 'saveConfigSet.post',
                'listener' => EventListener\Config\RemoveConfigCacheFile::class,
                'priority' => -100,
            ],
        ],
    ],
];
