<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Wizard\Step;

use WellCart\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class BackendUserForm extends Form implements
    InputFilterProviderInterface
{

    /**
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->add(
            [
                'name'       => 'email',
                'type'       => 'Text',
                'options'    => [
                    'label'      => __('Email'),
                    'help-block' => __(
                        "This email address will be your username to access Control Panel."
                    ),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'password',
                'type'       => 'password',
                'options'    => [
                    'label'      => __('Password'),
                    'help-block' => __("Must be at least 6 characters."),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'password_confirm',
                'type'       => 'password',
                'options'    => [
                    'label' => __('Re-type to confirm'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ],
            ['priority' => 640]
        );

        $this->add(
            [
                'name'       => 'first_name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('First Name'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'last_name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Last Name'),
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ],
            ['priority' => 550]
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
            'email'            =>
                [
                    'name'       => 'email',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty'     => [
                            'name' => 'NotEmpty',
                        ],
                        'EmailAddress' => [
                            'name' => 'EmailAddress',
                        ],
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 255,
                            ],
                        ],
                    ],
                ],
            'password'         =>
                [
                    'name'       => 'password',
                    'required'   => true,
                    'filters'    => [
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 6
                            ],
                        ],
                    ],
                ],
            'password_confirm' =>
                [
                    'name'       => 'password_confirm',
                    'required'   => true,
                    'filters'    => [
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 6
                            ],
                        ],
                        'Identical'    => [
                            'name'    => 'Identical',
                            'options' => [
                                'token' => 'password'
                            ]
                        ],
                    ],
                ],
            'first_name'       =>
                [
                    'name'       => 'first_name',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty'     => [
                            'name' => 'NotEmpty',
                        ],
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 255,
                            ],
                        ],
                    ],
                ],
            'last_name'        =>
                [
                    'name'       => 'last_name',
                    'required'   => true,
                    'filters'    => [
                        'StripTags'     => ['name' => 'StripTags'],
                        'StringTrim'    => ['name' => 'StringTrim'],
                        'StripNewlines' => ['name' => 'StripNewlines'],
                        'Null'          => ['name' => 'Null'],
                    ],
                    'validators' => [
                        'NotEmpty'     => [
                            'name' => 'NotEmpty',
                        ],
                        'StringLength' => [
                            'name'    => 'StringLength',
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 255,
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
