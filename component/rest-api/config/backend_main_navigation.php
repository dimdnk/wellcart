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
            'zfcadmin/api/oauth2-clients'     => [
                'label'      => 'OAuth2 Clients',
                'route'      => 'zfcadmin/api/oauth2-clients',
                'controller' => 'WellCart\RestApi\Controller\Admin\OAuth2\Clients',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'api/oauth2-clients/list',
            ],
            'zfcadmin/api/oauth2-scopes'      => [
                'label'      => 'Scopes',
                'route'      => 'zfcadmin/api/oauth2-scopes',
                'controller' => 'WellCart\RestApi\Controller\Admin\OAuth2\Scopes',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'api/oauth2-scopes/list',
            ],
            'zfcadmin/api/oauth2-public-keys' => [
                'label'      => 'Public Keys',
                'route'      => 'zfcadmin/api/oauth2-public-keys',
                'controller' => 'WellCart\RestApi\Controller\Admin\OAuth2\PublicKeys',
                'action'     => 'list',
                'order'      => -300,
                'permission' => 'api/oauth2-public-keys/list',
            ],
        ],
    ],
];
