<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Admin;

return [
    'backend' => [
        /**
         * Session configuration
         */
        'session'              => [
            'config' => [
                'options' => [
                    'name' => 'wellcart_backend_sid',
                ],
            ],
        ],
        'doctrine'             => [
            'authentication' => [
                'orm_default' => [
                    'identity_class'      => 'WellCart\Admin\Entity\Administrator',
                    'identity_property'   => 'email',
                    'credential_property' => 'password',
                ],
            ],
        ],

        'zfcuser'              => [
            'user_entity_class'    => 'WellCart\Admin\Entity\Administrator',
            'auth_identity_fields' => ['email'],
            'enable_registration'  => false,
            'enable_username'      => false,
            'table_name'           => 'admin_users',
        ],

        'user_account_options' => [
            'registration' => [
                'send_welcome_email' => false,
                'confirm_email'      => false,
            ],
        ],
    ],
];
