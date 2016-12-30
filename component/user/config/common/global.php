<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


return [
    'wellcart' => [
        'user_account_options' => [
            'max_login_attempts' => 5,
            'password_reset'     => [
                'email_contact'          => 'support',
                'email_template'         => 'wellcart-user/password_reset',
                'link_expiration_period' => 1,
                'allow_for_admin'        => true,
            ],
            'registration'       => [
                'send_welcome_email' => true,
                'confirm_email'      => true,
                'email_contact'      => 'general',
                'email_template'     => [
                    'welcome'            => 'wellcart-user/welcome',
                    'email_confirmation' => 'wellcart-user/email_confirmation',
                    'email_confirmed'    => 'wellcart-user/email_confirmed',
                ],
            ],
        ],
    ],
];
