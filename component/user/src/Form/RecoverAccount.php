<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Form;

use Zend\InputFilter\InputFilterProviderInterface;

class RecoverAccount extends \WellCart\Form\Form
    implements InputFilterProviderInterface
{

    /**
     * Form constructor
     */
    public function __construct()
    {
        parent::__construct('recover_account');

        $this->setWrapElements(true);

        $this->add(
            [
                'name'       => 'email',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Email Address'),
                ],
                'attributes' => [
                    'id'           => 'recover_account_email',
                    'autocomplete' => 'off',
                    'required'     => 'required',
                ],
            ],
            ['priority' => 1000]
        );

        $this->add(
            [
                'name'       => 'submit',
                'type'       => 'Submit',
                'options'    => [
                    'label' => __('Reset Password'),
                ],
                'attributes' => [
                    'class'             => 'btn btn-primary btn-block btn-signin',
                    'role'              => 'button',
                    'value'             => __('Reset Password'),
                    'data-disable-with' => __('Reset Password'),
                    'id'                => 'recover_account_submit_form',
                ],
            ],
            ['priority' => 500]
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
            'email' =>
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
                        'ObjectExists' => [
                            'name'    => 'WellCart\ORM\Validator\ObjectExists',
                            'options' => [
                                'entity_class' => 'WellCart\User\Entity\User',
                                'fields'       => ['email'],
                                'messages'     => [
                                    'noObjectFound' => 'No such user exists. Please make sure that you entered your email correctly.'
                                ],
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
