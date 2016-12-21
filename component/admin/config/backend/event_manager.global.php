<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Admin;

use WellCart\Base\Service\ConfigurationEditor;

return [
    'event_manager' => [
        'aggregates' => [],
        'listeners' => [
            EventListener\RemoveConfigCacheFile::class => [
                'id' => ConfigurationEditor::class,
                'event' => 'saveConfigSet.post',
                'listener' => EventListener\RemoveConfigCacheFile::class,
                'priority' => -100,
            ],
        ],
    ]
];
