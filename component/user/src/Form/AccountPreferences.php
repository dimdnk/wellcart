<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Form;

use WellCart\Mvc\Application;
use WellCart\Ui\Form\TabbedForm as AbstractForm;
use WellCart\Utility\Config;
use Zend\Form\Factory;
use Zend\InputFilter\InputFilterProviderInterface;

class AccountPreferences extends AbstractForm
    implements InputFilterProviderInterface
{
    /**
     * Canonical form name
     */
    const NAME = 'user_account_preferences';

    protected $backButton = false;

    protected $resetButton = false;

    /**
     * Form constructor
     *
     */
    public function __construct(Factory $factory)
    {
        $this->setFormFactory($factory);
        parent::__construct(static::NAME);

        $this->setWrapElements(true);

        $this->add(
            [
                'name'       => 'zfcuser.enable_registration',
                'options'    => [
                    'context'       => Application::CONTEXT_FRONTEND,
                    'label'         => __('Enable Registration'),
                    'help-block'    => __(
                        "Allows users to register through the website."
                    ),
                    'value_options' => [
                        0 => __('No'),
                        1 => __('Yes'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => (int)Config::get(
                        'context_specific.frontend.zfcuser.enable_registration',
                        1
                    ),
                ],
                'type'       => 'select',
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'type'       => 'baseEmailContactSelector',
                'name'       => 'wellcart.user_account_options.registration.email_contact',
                'options'    => [
                    'label' => __('Email Sender'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => Config::get(
                        'wellcart.user_account_options.registration.email_contact'
                    ),
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'wellcart.user_account_options.registration.send_welcome_email',
                'options'    => [
                    'context'       => Application::CONTEXT_FRONTEND,
                    'label'         => __('Send Welcome Email'),
                    'value_options' => [
                        0 => __('No'),
                        1 => __('Yes'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => (int)Config::get(
                        'context_specific.frontend.wellcart.user_account_options.registration.send_welcome_email',
                        1
                    ),
                ],
                'type'       => 'select',
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'wellcart.user_account_options.registration.confirm_email',
                'options'    => [
                    'context'       => Application::CONTEXT_FRONTEND,
                    'label'         => __('Require Emails Confirmation'),
                    'value_options' => [
                        0 => __('No'),
                        1 => __('Yes'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => (int)Config::get(
                        'context_specific.frontend.wellcart.user_account_options.registration.confirm_email',
                        1
                    ),
                ],
                'type'       => 'select',
            ],
            ['priority' => 550]
        );

        $this->add(
            [
                'name'       => 'zfcuser.login_form_timeout',
                'options'    => [
                    'label'      => __('Login Form Timeout'),
                    'help-block' => __(
                        "Specify the timeout for the CSRF security field of the login form in seconds."
                    ),
                ],
                'attributes' => [
                    'value' => Config::get(
                        'zfcuser.login_form_timeout'
                    ),
                ],
                'type'       => 'Text',
            ],
            ['priority' => 500]
        );

        $this->add(
            [
                'name'       => 'zfcuser.user_form_timeout',
                'options'    => [
                    'label'      => __('Registration Form Timeout'),
                    'help-block' => __(
                        "Specify the timeout for the CSRF security field of the registration form."
                    ),
                ],
                'attributes' => [
                    'value' => Config::get(
                        'zfcuser.user_form_timeout'
                    ),
                ],
                'type'       => 'Text',
            ],
            ['priority' => 450]
        );

        $this->add(
            [
                'name'       => 'wellcart.user_account_options.max_login_attempts',
                'options'    => [
                    'label'      => __('Max Login Attempts'),
                    'help-block' => __(
                        "Maximum login attempts allowed before the account is locked."
                    ),
                ],
                'attributes' => [
                    'value' => Config::get(
                        'wellcart.user_account_options.max_login_attempts'
                    ),
                ],
                'type'       => 'Text',
            ],
            ['priority' => 400]
        );


        $this->add(
            [
                'type'       => 'baseEmailContactSelector',
                'name'       => 'wellcart.user_account_options.password_reset.email_contact',
                'options'    => [
                    'label' => __('Email Sender'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => Config::get(
                        'wellcart.user_account_options.password_reset.email_contact'
                    ),
                ],
            ],
            ['priority' => 350]
        );

        $this->add(
            [
                'name'       => 'wellcart.user_account_options.password_reset.allow_for_admin',
                'options'    => [
                    'label'         => __('Allow Admin Password Reset'),
                    'value_options' => [
                        0 => __('No'),
                        1 => __('Yes'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => (int)Config::get(
                        'wellcart.user_account_options.password_reset.allow_for_admin',
                        1
                    ),
                ],
                'type'       => 'select',
            ],
            ['priority' => 340]
        );

        $this->add(
            [
                'name'       => 'wellcart.user_account_options.password_reset.link_expiration_period',
                'options'    => [
                    'label'      => __('Reset Link Expiration Period'),
                    'help-block' => __("In days"),
                ],
                'attributes' => [
                    'value' => Config::get(
                        'wellcart.user_account_options.password_reset.link_expiration_period'
                    ),
                ],
                'type'       => 'Text',
            ],
            ['priority' => 330]
        );

        $this->addToolbarAction(
            [
                'name'    => 'save',
                'type'    => 'Submit',
                'options' => [
                    'label' => __('Save'),
                ],
            ]
        );

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Input filter specification
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {

        $specification = [
            'zfcuser.enable_registration'                                         =>
                [
                    'name'       => 'zfcuser.enable_registration',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 0,
                                'max' => 1,
                            ],
                        ],
                    ],
                ],
            'wellcart.user_account_options.registration.send_welcome_email'       =>
                [
                    'name'       => 'wellcart.user_account_options.registration.send_welcome_email',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 0,
                                'max' => 1,
                            ],
                        ],
                    ],
                ],
            'wellcart.user_account_options.registration.confirm_email'            =>
                [
                    'name'       => 'wellcart.user_account_options.registration.confirm_email',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 0,
                                'max' => 1,
                            ],
                        ],
                    ],
                ],
            'wellcart.user_account_options.password_reset.allow_for_admin'        =>
                [
                    'name'       => 'wellcart.user_account_options.password_reset.allow_for_admin',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 0,
                                'max' => 1,
                            ],
                        ],
                    ],
                ],
            'wellcart.user_account_options.max_login_attempts'                    =>
                [
                    'name'       => 'wellcart.user_account_options.max_login_attempts',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 1,
                                'max' => 20,
                            ],
                        ],
                    ],
                ],
            'zfcuser.login_form_timeout'                                          =>
                [
                    'name'       => 'zfcuser.login_form_timeout',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 100,
                                'max' => 600,
                            ],
                        ],
                    ],
                ],
            'zfcuser.user_form_timeout'                                           =>
                [
                    'name'       => 'zfcuser.user_form_timeout',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 100,
                                'max' => 600,
                            ],
                        ],
                    ],
                ],
            'wellcart.user_account_options.password_reset.link_expiration_period' =>
                [
                    'name'       => 'wellcart.user_account_options.password_reset.link_expiration_period',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty' => [
                            'name' => 'NotEmpty',
                        ],
                        'Digits'   => [
                            'name' => 'Digits',
                        ],
                        'Between'  => [
                            'name'    => 'Between',
                            'options' => [
                                'min' => 1,
                                'max' => 5,
                            ],
                        ],
                    ],
                ],
        ];

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            ['specification' => &$specification]
        );

        return $specification;
    }
}
