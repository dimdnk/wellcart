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
                    'zfcadmin/api/oauth2-clients'     => [
                        'label'      => 'OAuth2 Clients',
                        'route'      => 'zfcadmin/api/oauth2-clients',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'api/oauth2-clients/list',
                    ],
                    'zfcadmin/api/oauth2-scopes'      => [
                        'label'      => 'Scopes',
                        'route'      => 'zfcadmin/api/oauth2-scopes',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'api/oauth2-scopes/list',
                    ],
                    'zfcadmin/api/oauth2-public-keys' => [
                        'label'      => 'Public Keys',
                        'route'      => 'zfcadmin/api/oauth2-public-keys',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'api/oauth2-public-keys/list',
                    ],
                ],
            ],
        ],
    ],
];
