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
                'headLink' => [
                    'wellcart-setup-ui/style.css' => ['href' => 'themes/wellcart-setup-ui/css/style.css'],
                ],
            ],
            'blocks'  => [
                'setup:WellCart\Setup\ItemView\Header' => [
                    'capture_to' => 'PageHeader',
                    'class'      => 'WellCart\Setup\ItemView\Header',
                    'options'    => [
                        'order' => -950
                    ]
                ],

                'setup:WellCart\Base\ItemView\Copyright' => [
                    'capture_to' => 'PageFooter',
                    'class'      => 'WellCart\Base\ItemView\Copyright',
                    'options'    => [
                        'order' => -950
                    ]
                ],
            ]
        ],
    ],
];
