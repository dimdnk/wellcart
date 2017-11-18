<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'navigation' => [
        'backend_main_navigation' => [
            'wellcart-backend/system-settings' => [
                'pages' => [
                    'backend/directory/currencies' => [
                        'label'      => 'Currencies',
                        'route'      => 'backend/directory/currencies',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'directory/currencies/list',
                    ],
                    'backend/directory/countries'  => [
                        'label'      => 'Countries',
                        'route'      => 'backend/directory/countries',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'directory/countries/list',
                    ],
                    'backend/directory/zones'      => [
                        'label'      => 'Zones',
                        'route'      => 'backend/directory/zones',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'directory/zones/list',
                    ],
                    'backend/directory/geo-zones'  => [
                        'label'      => 'Geo Zones',
                        'route'      => 'backend/directory/geo-zones',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'directory/geo-zones/list',
                    ],
                ],
            ],
        ],
    ],
];
