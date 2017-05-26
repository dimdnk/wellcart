<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Setup;

return [
    'wellcart' => [
        'website'              => [
            'name' => 'WellCart',
        ],
        'email_communications' => [
            'enabled' => false,
        ],
        'user_account_options' => [
            'registration' => [
                'send_welcome_email' => false,
                'confirm_email'      => false,
            ],
        ],
    ],

    /**
     * Session configuration
     */
    'session'      => [
        'config'     => [
            'options' => [
                'name'           => 'wellcart_setup_sid',
                'gc_probability' => 1,
            ],
        ],
        'storage'    => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => [
            [
                'Zend\Session\Validator\RemoteAddr',
                'Zend\Session\Validator\HttpUserAgent',
            ],
        ],
    ],

    /**
     * =========================================================
     * View manager configuration
     * =========================================================
     */
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'layout'                   => 'layout/setup-wizard',
        'template_path_stack'      => [
            __DIR__ . '/../../view',
        ],
    ],
    'ze_theme'     => [
        'default_theme' => 'wellcart-setup-ui',
        'routes'        => [],
    ],
    'wizard'       => [
        /**
         * Default layout template of the wizard
         */
        'default_layout_template' => 'wellcart-setup/step',
        'wizards'                 => [
            'setup' => [
                'redirect_url' => '/',
                'steps'        => [
                    'WellCart\Setup\Wizard\Step\License'         => [
                        'title'         => 'License Agreement',
                        'view_template' => 'wellcart-setup/step/license',
                    ],
                    'WellCart\Setup\Wizard\Step\Requirements'    => [
                        'title'         => 'System Requirements',
                        'view_template' => 'wellcart-setup/step/requirements',
                    ],
                    'WellCart\Setup\Wizard\Step\DbConfiguration' => [
                        'title'         => 'Configuration',
                        'view_template' => 'wellcart-setup/step/db-configuration',
                    ],
                    'WellCart\Setup\Wizard\Step\AdminUser'       => [
                        'title'         => 'Admin User',
                        'view_template' => 'wellcart-setup/step/admin-user',
                    ],
                    'WellCart\Setup\Wizard\Step\Complete'        => [
                        'title'         => 'Complete',
                        'view_template' => 'wellcart-setup/step/complete',
                    ],
                ],
            ],
        ],
    ],
    'wizard_steps' => [],
];
