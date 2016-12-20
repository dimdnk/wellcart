<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'navigation' => [
        'backend_main_navigation' => [
            'wellcart-admin/dashboard'       => [
                'label'      => 'Dashboard',
                'icon'       => 'fa fa-dashboard',
                'route'      => 'zfcadmin',
                'order'      => -5000,
                'permission' => 'admin/dashboard/view',
            ],
            'wellcart-admin/system-settings' => [
                'label'      => 'Configuration',
                'icon'       => 'icon-gear',
                'route'      => 'zfcadmin/system-settings',
                'order'      => 5000,
                'permission' => 'admin/system-settings/general/view',
                'pages'      => [
                    'wellcart-admin/system-settings' => [
                        'label'      => 'System Settings',
                        'icon'       => 'fa fa-cog',
                        'route'      => 'zfcadmin/system-settings/sections',
                        'params'     => ['section' => 'general'],
                        'order'      => 9500,
                        'permission' => 'admin/system-settings/general/view',
                    ]
                ],
            ],

            'wellcart-user/accounts'         => [
                'pages' => [
                    'zfcadmin/admin/accounts' => [
                        'label'      => 'Administrators',
                        'route'      => 'zfcadmin/admin/accounts',
                        'action'     => 'list',
                        'order'      => -600,
                        'permission' => 'admin/accounts/list',
                    ],
                ],
            ],
        ],
    ],
];
