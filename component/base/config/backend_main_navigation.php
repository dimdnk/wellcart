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
                'controller' => 'WellCart\Base\Controller\Admin\Languages',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'base/languages/list',
            ],
            'zfcadmin/base/url-rewrites'     => [
                'label'      => 'URL Rewrites',
                'route'      => 'zfcadmin/base/url-rewrites',
                'controller' => 'WellCart\Base\Controller\Admin\UrlRewrites',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'base/url-rewrites/list',
            ],
        ],
    ],
];
