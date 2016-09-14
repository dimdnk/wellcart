<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'backend/wellcart-backend-ui' => [
        'default' => [
            'helpers' => [
                'headLink'  => [
                    'wellcart-backend-ui/style.css' => ['href' => 'themes/wellcart-backend-ui/css/style.css'],
                ],
                'requireJS' => [
                    'wellcart-admin/js/helpers'   => ['dependencies' => ['assets/wellcart-admin/js/helpers']],
                    'wellcart-admin/js/bootstrap' => ['dependencies' => ['assets/wellcart-admin/js/bootstrap']],
                ]
            ],
            'blocks'  => [

                'backend:WellCart\Admin\ItemView\TopBranding'        => [
                    'capture_to' => 'PageHeader',
                    'class'      => 'WellCart\Admin\ItemView\TopBranding',
                    'options'    => [
                        'order' => -950
                    ]
                ],

                'backend:WellCart\Admin\ItemView\Account\WelcomeBox' => [
                    'capture_to' => 'LeftSidebar',
                    'class'      => 'WellCart\Admin\ItemView\Account\WelcomeBox',
                    'options'    => [
                        'order' => -950
                    ]
                ],

                'backend:WellCart\Admin\ItemView\MainNavigationMenu' => [
                    'capture_to' => 'LeftSidebar',
                    'class'      => 'WellCart\Admin\ItemView\MainNavigationMenu',
                    'options'    => [
                        'order' => -950
                    ]
                ],


                'backend:WellCart\Base\ItemView\Copyright'           => [
                    'capture_to' => 'PageFooter',
                    'class'      => 'WellCart\Base\ItemView\Copyright',
                    'options'    => [
                        'order' => -950
                    ]
                ],
            ],

        ],
    ],
    'global'                      => [
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
    'backend/unauthorized'        => [
        'default' => [
            'helpers' => [
                'headLink' => [
                    'themes/wellcart-backend-ui/css/authentication.css' => ['href' => 'themes/wellcart-backend-ui/css/authentication.css'],
                ],
            ],
        ],
    ],
];
