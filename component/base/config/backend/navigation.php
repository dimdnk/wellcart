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
                    'wellcart-backend/system-settings' => [
                        'label'      => 'System Settings',
                        'route'      => 'backend/system-settings/sections',
                        'params'     => ['section' => 'general'],
                        'order'      => 9500,
                        'permission' => 'admin/system-settings/general/view',
                    ],
                    'backend/base/languages'          => [
                        'label'      => 'Languages',
                        'route'      => 'backend/base/languages',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'base/languages/list',
                    ],
                    'backend/base/url-rewrites'       => [
                        'label'      => 'URL Rewrites',
                        'route'      => 'backend/base/url-rewrites',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'base/url-rewrites/list',
                    ],
                ],
            ],
        ],
    ],
];
