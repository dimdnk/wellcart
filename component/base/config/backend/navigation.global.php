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
            'wellcart-admin/system-settings' => [
                'pages' => [
                    'wellcart-admin/system-settings' => [
                        'label'      => 'System Settings',
                        'route'      => 'zfcadmin/system-settings/sections',
                        'params'     => ['section' => 'general'],
                        'order'      => 9500,
                        'permission' => 'admin/system-settings/general/view',
                    ],
                    'zfcadmin/base/languages'        => [
                        'label'      => 'Languages',
                        'route'      => 'zfcadmin/base/languages',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'base/languages/list',
                    ],
                    'zfcadmin/base/url-rewrites'     => [
                        'label'      => 'URL Rewrites',
                        'route'      => 'zfcadmin/base/url-rewrites',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'base/url-rewrites/list',
                    ],
                ],
            ],
        ],
    ],
];
