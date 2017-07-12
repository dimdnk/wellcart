<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'view_manager' => [
        'template_map' => [
            'zfc-user/user/register'                 => __DIR__
                . '/../../view/template/register.phtml',
            'well-cart/user/index'                   => __DIR__
                . '/../../view/template/index.phtml',
            'well-cart/user/register'                => __DIR__
                . '/../../view/template/register.phtml',
            'well-cart/user/login'                   => __DIR__
                . '/../../view/template/login.phtml',
            'well-cart/user/changeemail'             => __DIR__
                . '/../../view/template/changeemail.phtml',
            'well-cart/user/changepassword'          => __DIR__
                . '/../../view/template/changepassword.phtml',
            'zfc-user/user/login'                    => __DIR__
                . '/../../view/template/login.phtml',
            'wellcart-user/recover-account/initiate' => __DIR__
                . '/../../view/template/recover-account/initiate.phtml',
            'wellcart-user/recover-account/reset'    => __DIR__
                . '/../../view/template/recover-account/reset.phtml',
            'mail/wellcart-user/welcome'             => __DIR__
                . '/../../view/mail/welcome.phtml',
            'mail/wellcart-user/email_confirmation'  => __DIR__
                . '/../../view/mail/email_confirmation.phtml',
            'mail/wellcart-user/email_confirmed'     => __DIR__
                . '/../../view/mail/email_confirmed.phtml',
            'mail/wellcart-user/password_reset'      => __DIR__
                . '/../../view/mail/password_reset.phtml',
        ],

    ],
];
