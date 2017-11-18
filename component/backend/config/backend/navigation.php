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
            'wellcart-backend/dashboard'       => [
                'label'      => 'Dashboard',
                'icon'       => 'fa fa-dashboard',
                'route'      => 'backend',
                'order'      => -5000,
                'permission' => 'admin/dashboard/view',
            ],
            'wellcart-backend/system-settings' => [
                'label'      => 'Configuration',
                'icon'       => 'icon-gear',
                'route'      => 'backend/system-settings',
                'order'      => 5000,
                'permission' => 'admin/system-settings/general/view',
                'pages'      => [
                    'wellcart-backend/system-settings' => [
                        'label'      => 'System Settings',
                        'icon'       => 'fa fa-cog',
                        'route'      => 'backend/system-settings/sections',
                        'params'     => ['section' => 'general'],
                        'order'      => 9500,
                        'permission' => 'admin/system-settings/general/view',
                    ],
                ],
            ],

            'wellcart-user/accounts' => [
                'pages' => [
                    'backend/admin/accounts' => [
                        'label'      => 'Administrators',
                        'route'      => 'backend/admin/accounts',
                        'action'     => 'list',
                        'order'      => -600,
                        'permission' => 'admin/accounts/list',
                    ],
                ],
            ],
        ],
    ],
];
