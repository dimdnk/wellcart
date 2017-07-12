<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\User\Form;

$forms = [
    Form\AccountPreferences::NAME => [
        'options' => [
            'tabs' => [
                'login'            => [
                    'label'    => 'Log In',
                    'elements' => [
                        'zfcuser.login_form_timeout',
                        'wellcart.user_account_options.max_login_attempts',
                    ],
                ],
                'registration'     => [
                    'label'    => 'Registration',
                    'elements' => [
                        'zfcuser.enable_registration',
                        'zfcuser.user_form_timeout',
                        'wellcart.user_account_options.registration.email_contact',
                        'wellcart.user_account_options.registration.send_welcome_email',
                        'wellcart.user_account_options.registration.confirm_email',
                    ],
                ],
                'password_options' => [
                    'label'    => 'Password Options',
                    'elements' => [
                        'wellcart.user_account_options.password_reset.email_contact',
                        'wellcart.user_account_options.password_reset.allow_for_admin',
                        'wellcart.user_account_options.password_reset.link_expiration_period',
                    ],
                ],
            ],
        ],
        'save'    => [
            'options'    => [
                'fontAwesome' => [
                    'icon' => 'check',
                ],
            ],
            'attributes' => [
                'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
            ],
        ],

        'zfcuser.enable_registration' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'wellcart.user_account_options.registration.send_welcome_email' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'zfcuser.login_form_timeout' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'zfcuser.user_form_timeout' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'wellcart.user_account_options.max_login_attempts' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'wellcart.user_account_options.password_reset.email_contact' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'ellcart.user_account_options.registration.email_contact' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'wellcart.user_account_options.registration.email_contact' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'wellcart.user_account_options.registration.confirm_email' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'wellcart.user_account_options.password_reset.allow_for_admin' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],

        'wellcart.user_account_options.password_reset.link_expiration_period' => [
            'options' => [
                'twb-layout'       => 'horizontal',
                'column-size'      => 'md-9',
                'label_attributes' => [
                    'class' => 'col-md-3',
                ],
            ],
        ],
    ],
];

return [
    'ui' => [
        'component' => [
            'form' => $forms,
        ],
    ],
];
