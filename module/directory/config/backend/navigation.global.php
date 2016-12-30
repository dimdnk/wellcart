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
                    'zfcadmin/directory/currencies' => [
                        'label'      => 'Currencies',
                        'route'      => 'zfcadmin/directory/currencies',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'directory/currencies/list',
                    ],
                    'zfcadmin/directory/countries'  => [
                        'label'      => 'Countries',
                        'route'      => 'zfcadmin/directory/countries',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'directory/countries/list',
                    ],
                    'zfcadmin/directory/zones'      => [
                        'label'      => 'Zones',
                        'route'      => 'zfcadmin/directory/zones',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'directory/zones/list',
                    ],
                    'zfcadmin/directory/geo-zones'  => [
                        'label'      => 'Geo Zones',
                        'route'      => 'zfcadmin/directory/geo-zones',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'directory/geo-zones/list',
                    ],
                ],
            ],
        ],
    ],
];
