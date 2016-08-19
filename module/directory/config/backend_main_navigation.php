<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'wellcart-admin/system-settings' => [
        'pages' => [
            'zfcadmin/directory/currencies' => [
                'label'      => 'Currencies',
                'route'      => 'zfcadmin/directory/currencies',
                'controller' => 'WellCart\Directory\Controller\Admin\Currencies',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'directory/currencies/list',
            ],
            'zfcadmin/directory/countries'  => [
                'label'      => 'Countries',
                'route'      => 'zfcadmin/directory/countries',
                'controller' => 'WellCart\Directory\Controller\Admin\Countries',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'directory/countries/list',
            ],
            'zfcadmin/directory/zones'      => [
                'label'      => 'Zones',
                'route'      => 'zfcadmin/directory/zones',
                'controller' => 'WellCart\Directory\Controller\Admin\Zones',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'directory/zones/list',
            ],
            'zfcadmin/directory/geo-zones'  => [
                'label'      => 'Geo Zones',
                'route'      => 'zfcadmin/directory/geo-zones',
                'controller' => 'WellCart\Directory\Controller\Admin\GeoZones',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'directory/geo-zones/list',
            ],
        ],
    ],
];
