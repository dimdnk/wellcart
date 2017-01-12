<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'layout_updates' => [
        'backend/theme/wellcart-backend-ui' => [
            'ui/grid/standard' => [
                'blocks' => [
                    'page.header.head'                       => [
                        'capture_to' => 'PageHeader',
                        'parent'     => 'action.result',
                        'class'      => 'WellCart\Backend\ItemView\PageHead',
                        'blocks'     => [
                            'page.navigation.breadcrumbs' => [
                                'capture_to' => 'breadcrumbs',
                                'parent'     => 'page.header.head',
                                'class'      => 'WellCart\Backend\ItemView\PageNavigator',
                            ],
                        ],
                    ],
                    'page.notifications.flash_notifications' => [
                        'capture_to' => 'PrePageContent',
                        'parent'     => 'action.result',
                        'class'      => 'WellCart\Base\ItemView\FlashNotifications',
                    ],
                    'page.notifications.notifications'       => [
                        'capture_to' => 'PrePageContent',
                        'parent'     => 'action.result',
                        'class'      => 'WellCart\Base\ItemView\Notifications',
                    ],
                ],
            ],
            'ui/form/standard' => [
                'blocks' => [
                    'page.header.head'                       => [
                        'capture_to' => 'PageHeader',
                        'parent'     => 'action.result',
                        'class'      => 'WellCart\Backend\ItemView\PageHead',
                        'blocks'     => [
                            'page.navigation.breadcrumbs' => [
                                'capture_to' => 'breadcrumbs',
                                'parent'     => 'page.header.head',
                                'class'      => 'WellCart\Backend\ItemView\PageNavigator',
                            ],
                        ],
                    ],
                    'page.notifications.flash_notifications' => [
                        'capture_to' => 'PrePageContent',
                        'parent'     => 'action.result',
                        'class'      => 'WellCart\Base\ItemView\FlashNotifications',
                    ],
                    'page.notifications.notifications'       => [
                        'capture_to' => 'PrePageContent',
                        'parent'     => 'action.result',
                        'class'      => 'WellCart\Base\ItemView\Notifications',
                    ],
                ],
            ],
        ],
    ],
];
