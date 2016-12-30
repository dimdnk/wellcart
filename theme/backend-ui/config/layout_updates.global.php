<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'backend/theme/wellcart-backend-ui' => [
        'default' => [
            'helpers' => [
                'headLink'  => [
                    'wellcart-backend-ui/style.css' => ['href' => 'themes/wellcart-backend-ui/css/style.css'],
                ],
                'requireJS' => [
                    'wellcart-backend/js/helpers'   => ['dependencies' => ['assets/wellcart-backend/js/helpers']],
                    'wellcart-backend/js/bootstrap' => ['dependencies' => ['assets/wellcart-backend/js/bootstrap']],
                ]
            ],
            'blocks'  => [

                'backend:WellCart\Backend\ItemView\TopBranding' => [
                    'capture_to' => 'PageHeader',
                    'class'      => 'WellCart\Backend\ItemView\TopBranding',
                    'options'    => [
                        'order' => -950
                    ]
                ],

                'backend:WellCart\Backend\ItemView\Account\WelcomeBox' => [
                    'capture_to' => 'LeftSidebar',
                    'class'      => 'WellCart\Backend\ItemView\Account\WelcomeBox',
                    'options'    => [
                        'order' => -950
                    ]
                ],

                'backend:WellCart\Backend\ItemView\MainNavigationMenu' => [
                    'capture_to' => 'LeftSidebar',
                    'class'      => 'WellCart\Backend\ItemView\MainNavigationMenu',
                    'options'    => [
                        'order' => -950
                    ]
                ],


                'backend:WellCart\Base\ItemView\Copyright' => [
                    'capture_to' => 'PageFooter',
                    'class'      => 'WellCart\Base\ItemView\Copyright',
                    'options'    => [
                        'order' => -950
                    ]
                ],
            ],

        ],
    ],
    'global'                            => [
        'guard-unauthorized' => [
            'helpers' => [
                'headLink' => [
                    'themes/wellcart-backend-ui/css/authentication.css' => ['href' => 'themes/wellcart-backend-ui/css/authentication.css'],
                ],
            ],
            'blocks'  => [
                'page.notifications.flash_notifications' => [
                    'capture_to' => 'notifications',
                    'parent'     => 'action.result',
                    'class'      => 'WellCart\Base\ItemView\FlashNotifications',
                ],
                'page.notifications.notifications'       => [
                    'capture_to' => 'notifications',
                    'parent'     => 'action.result',
                    'class'      => 'WellCart\Base\ItemView\Notifications',
                ],
            ],
        ],
    ],
    'backend/unauthorized'              => [
        'default' => [
            'helpers' => [
                'headLink' => [
                    'themes/wellcart-backend-ui/css/authentication.css' => ['href' => 'themes/wellcart-backend-ui/css/authentication.css'],
                ],
            ],
        ],
    ],
];
