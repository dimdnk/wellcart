<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Form;

use WellCart\Ui\Form\TabbedForm as AbstractForm;
use WellCart\Utility\Config;
use Zend\Form\Factory;
use Zend\InputFilter\InputFilterProviderInterface;

class AccountPreferences extends AbstractForm
    implements InputFilterProviderInterface
{
    protected $backButton = false;
    protected $resetButton = false;

    /**
     * Form constructor
     *
     */
    public function __construct(Factory $factory)
    {
        $this->setFormFactory($factory);
        parent::__construct('preferences');

        $this->setWrapElements(true);

        $this->add(
            [
                'name'       => 'context_specific.frontend.zfcuser.enable_registration',
                'options'    => [
                    'label'            => __('Enable Registration'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'help-block'       => __(
                        "Allows users to register through the website."
                    ),
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
                    'value_options'    => [
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
                'name'       => 'user_account_options.registration.email_contact',
                'options'    => [
                    'label'            => __('Email Sender'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => Config::get(
                        'user_account_options.registration.email_contact'
                    ),
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'context_specific.frontend.user_account_options.registration.send_welcome_email',
                'options'    => [
                    'label'            => __('Send Welcome Email'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
                    'value_options'    => [
                        0 => __('No'),
                        1 => __('Yes'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => (int)Config::get(
                        'context_specific.frontend.user_account_options.registration.send_welcome_email',
                        1
                    ),
                ],
                'type'       => 'select',
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'context_specific.frontend.user_account_options.registration.confirm_email',
                'options'    => [
                    'label'            => __('Require Emails Confirmation'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
                    'value_options'    => [
                        0 => __('No'),
                        1 => __('Yes'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => (int)Config::get(
                        'context_specific.frontend.user_account_options.registration.confirm_email',
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
                    'label'            => __('Login Form Timeout'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'help-block'       => __(
                        "Specify the timeout for the CSRF security field of the login form in seconds."
                    ),
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
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
                    'label'            => __('Registration Form Timeout'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'help-block'       => __(
                        "Specify the timeout for the CSRF security field of the registration form."
                    ),
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
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
                'name'       => 'user_account_options.max_login_attempts',
                'options'    => [
                    'label'            => __('Max Login Attempts'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'help-block'       => __(
                        "Maximum login attempts allowed before the account is locked."
                    ),
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
                ],
                'attributes' => [
                    'value' => Config::get(
                        'user_account_options.max_login_attempts'
                    ),
                ],
                'type'       => 'Text',
            ],
            ['priority' => 400]
        );


        $this->add(
            [
                'type'       => 'baseEmailContactSelector',
                'name'       => 'user_account_options.password_reset.email_contact',
                'options'    => [
                    'label'            => __('Email Sender'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => Config::get(
                        'user_account_options.password_reset.email_contact'
                    ),
                ],
            ],
            ['priority' => 350]
        );

        $this->add(
            [
                'name'       => 'user_account_options.password_reset.allow_for_admin',
                'options'    => [
                    'label'            => __('Allow Admin Password Reset'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
                    'value_options'    => [
                        0 => __('No'),
                        1 => __('Yes'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'value'        => (int)Config::get(
                        'user_account_options.password_reset.allow_for_admin',
                        1
                    ),
                ],
                'type'       => 'select',
            ],
            ['priority' => 340]
        );

        $this->add(
            [
                'name'       => 'user_account_options.password_reset.link_expiration_period',
                'options'    => [
                    'label'            => __('Reset Link Expiration Period'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-9',
                    'help-block'       => __("In days"),
                    'label_attributes' => [
                        'class' => 'col-md-3',
                    ],
                ],
                'attributes' => [
                    'value' => Config::get(
                        'user_account_options.password_reset.link_expiration_period'
                    ),
                ],
                'type'       => 'Text',
            ],
            ['priority' => 330]
        );

        $this->addToolbarButton(
            [
                'name'       => 'save',
                'type'       => 'Submit',
                'options'    => [
                    'label'       => __('Save'),
                    'fontAwesome' => [
                        'icon' => 'check'
                    ],
                ],
                'attributes' => [
                    'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                ],
            ]
        );

        $this->getEventManager()->trigger('init', $this);
        $this->prepareTabs();
    }

    /**
     * Prepare tabs
     */
    protected function prepareTabs()
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);
        $this->addTab('login', __('Log In'));
        $login = $this->getTab('login');
        $fields = [
            'zfcuser.login_form_timeout',
            'user_account_options.max_login_attempts',
        ];
        foreach ($fields as $field) {
            $login->add($field, $this->get($field));
        }

        $this->addTab('registration', __('Registration'));
        $registration = $this->getTab('registration');
        $fields = [
            'context_specific.frontend.zfcuser.enable_registration',
            'zfcuser.user_form_timeout',
            'user_account_options.registration.email_contact',
            'context_specific.frontend.user_account_options.registration.send_welcome_email',
            'context_specific.frontend.user_account_options.registration.confirm_email',
        ];
        foreach ($fields as $field) {
            $registration->add($field, $this->get($field));
        }


        $this->addTab('password_options', __('Password Options'));
        $password = $this->getTab('password_options');
        $fields = [
            'user_account_options.password_reset.email_contact',
            'user_account_options.password_reset.allow_for_admin',
            'user_account_options.password_reset.link_expiration_period',
        ];
        foreach ($fields as $field) {
            $password->add($field, $this->get($field));
        }

        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this);
    }

    /**
     * Input filter specification
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {

        $specification = [
            'context_specific.frontend.zfcuser.enable_registration'                          =>
                [
                    'name'       => 'context_specific.frontend.zfcuser.enable_registration',
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
            'context_specific.frontend.user_account_options.registration.send_welcome_email' =>
                [
                    'name'       => 'context_specific.frontend.user_account_options.registration.send_welcome_email',
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
            'context_specific.frontend.user_account_options.registration.confirm_email'      =>
                [
                    'name'       => 'context_specific.frontend.user_account_options.registration.confirm_email',
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
            'user_account_options.password_reset.allow_for_admin'                            =>
                [
                    'name'       => 'user_account_options.password_reset.allow_for_admin',
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
            'user_account_options.max_login_attempts'                                        =>
                [
                    'name'       => 'user_account_options.max_login_attempts',
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
            'zfcuser.login_form_timeout'                                                     =>
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
            'zfcuser.user_form_timeout'                                                      =>
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
            'user_account_options.password_reset.link_expiration_period'                     =>
                [
                    'name'       => 'user_account_options.password_reset.link_expiration_period',
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
                ]
        ];

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            ['specification' => &$specification]
        );
        return $specification;
    }
}
