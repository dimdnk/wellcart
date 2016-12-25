<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'layout_updates' => [
        'backend/theme/wellcart-backend-ui' => [
            'directory/geo-zones/form' => [
                'helpers' => [
                    'requireJS' => [
                        'assets/wellcart-directory/js/geo-zone-configurator' => ['dependencies' => ['assets/wellcart-directory/js/geo-zone-configurator']],
                    ]
                ],
            ],
        ],
    ]
];
