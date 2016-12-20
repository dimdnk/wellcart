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
            'wellcart-user/accounts' => [
                'label'      => 'Users',
                'icon'       => 'icon-users2',
                'route'      => 'zfcadmin/user/accounts',
                'order'      => 5000,
                'permission' => 'user/accounts/list',
                'pages'      => [
                    'zfcadmin/user/accounts'    => [
                        'label'      => 'Member Accounts',
                        'route'      => 'zfcadmin/user/accounts',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'user/accounts/list',
                    ],
                    'zfcadmin/user/roles'       => [
                        'label'      => 'Manage Roles',
                        'route'      => 'zfcadmin/user/roles',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'user/roles/list',
                    ],
                    'zfcadmin/user/preferences' => [
                        'label'      => 'Signup & Signin Options',
                        'route'      => 'zfcadmin/user/preferences',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'user/preferences/view',
                    ],
                ],
            ],
        ],
    ],
];
