<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'global' => [
        'default' => [
            'helpers' => [
                'headLink'   => [
                    'wellcart-base/style.css' => ['href' => 'assets/wellcart-base/css/style.css'],
                ],
                'headScript' => [
                    'jquery'                    => ['src' => 'assets/lib/jquery/jquery.min.js'],
                    'jquery-ujs'                => ['src' => 'assets/lib/web-components/jquery-ujs.js'],
                    'bootstrap.hover-dropdown'  => ['src' => 'assets/lib/web-components/bootstrap-hover-dropdown.js'],
                    'jquery.validate'           => ['src' => 'assets/lib/web-components/validation/jquery.validate.js'],
                    'jquery.validate.methods'   => ['src' => 'assets/lib/web-components/validation/jquery.validate.methods.js'],
                    'jquery.validate.rules'     => ['src' => 'assets/lib/web-components/validation/rules.js'],
                    'jquery.validate.bootstrap' => ['src' => 'assets/lib/web-components/validation/bootstrap.js'],
                    'switchery'                 => ['src' => 'assets/lib/web-components/switchery/switchery.js'],
                ],
            ],

            'blocks' => [
                'base:WellCart\Base\ItemView\HtmlHead' => [
                    'capture_to' => 'HtmlHead',
                    'class'      => 'WellCart\Base\ItemView\HtmlHead',
                    'options'    => [
                        'order' => -950
                    ]
                ],

                'base:WellCart\Base\ItemView\HtmlNotices' => [
                    'capture_to' => 'PostBodyStart',
                    'class'      => 'WellCart\Base\ItemView\HtmlNotices',
                    'options'    => [
                        'order' => -950
                    ]
                ],


                'base:WellCart\Base\ItemView\Notifications' => [
                    'capture_to' => 'PrePageContent',
                    'class'      => 'WellCart\Base\ItemView\Notifications',
                    'options'    => [
                        'order' => 950
                    ]
                ],

                'base:WellCart\Base\ItemView\FlashNotifications' => [
                    'capture_to' => 'PrePageContent',
                    'class'      => 'WellCart\Base\ItemView\FlashNotifications',
                    'options'    => [
                        'order' => 950
                    ]
                ],


                'base:WellCart\Base\ItemView\HtmlFooter' => [
                    'capture_to' => 'PreBodyEnd',
                    'class'      => 'WellCart\Base\ItemView\HtmlFooter',
                    'options'    => [
                        'order' => 100
                    ]
                ],
            ],
        ],
    ]
];
