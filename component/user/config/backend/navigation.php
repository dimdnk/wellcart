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
            'wellcart-user/accounts' => [
                'label'      => 'Users',
                'icon'       => 'icon-users2',
                'route'      => 'backend/user/accounts',
                'order'      => 5000,
                'permission' => 'user/accounts/list',
                'pages'      => [
                    'backend/user/accounts'    => [
                        'label'      => 'Member Accounts',
                        'route'      => 'backend/user/accounts',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'user/accounts/list',
                    ],
                    'backend/user/roles'       => [
                        'label'      => 'Manage Roles',
                        'route'      => 'backend/user/roles',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'user/roles/list',
                    ],
                    'backend/user/preferences' => [
                        'label'      => 'Signup & Signin Options',
                        'route'      => 'backend/user/preferences',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'user/preferences/view',
                    ],
                ],
            ],
        ],
    ],
];
