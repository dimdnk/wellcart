<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Form;

use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\User\Exception;
use WellCart\User\Spec\UserEntity;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Account extends AbstractForm
{
    protected $passwordRequired = true;

    /**
     * Form constructor
     *
     * @param Factory        $factory
     * @param ObjectHydrator $hydrator
     */
    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator
    ) {
        $this->setFormFactory($factory);
        parent::__construct('user_account');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $this->add(
            [
                'name'       => 'email',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Email'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'           => 'user_account_name',
                    'autocomplete' => 'off',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'roles',
                'type'       => 'userRolesMultiCheckboxSelector',
                'options'    => [
                    'label'            => __('Roles'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'user_account_roles',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'language',
                'type'       => 'localeLanguageSelector',
                'options'    => [
                    'label'            => __('Language'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'user_account_language',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'time_zone',
                'type'       => 'timezoneSelector',
                'options'    => [
                    'label'            => __('Timezone'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'user_account_time_zone',
                    'required'     => 'required',
                ],
            ],
            ['priority' => 550]
        );

        $this->add(
            [
                'name'       => 'first_name',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('First Name'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'user_account_first_name',
                    'required'     => 'required',
                ],
            ],
            ['priority' => 500]
        );

        $this->add(
            [
                'name'       => 'last_name',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Last Name'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'user_account_last_name',
                    'required'     => 'required',
                ],
            ],
            ['priority' => 450]
        );

        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'user_account_csrf',
                ],
            ],
            ['priority' => 400]
        );

        $this->add(
            [
                'name'       => 'password',
                'type'       => 'password',
                'options'    => [
                    'label'            => __('New Password'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'user_account_password',
                    'type'         => 'password',
                ],
            ],
            ['priority' => 210]
        );

        $this->add(
            [
                'name'       => 'passwordVerify',
                'type'       => 'password',
                'options'    => [
                    'label'            => __('Password Verify'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'user_account_password_verify',
                    'type'         => 'password',
                ],
            ],
            ['priority' => 200]
        );


        $this->add(
            [
                'type'       => 'hidden',
                'name'       => 'state',
                'attributes' => [
                    'id'    => 'user_account_state',
                    'value' => 1,
                ],
            ],
            ['priority' => 700]
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

        $saveAndContinue = clone $this->get('save');
        $saveAndContinue
            ->setName('save_and_continue_edit')
            ->setLabel(__('Save & Continue Edit'))
            ->setOption('fontAwesome', ['icon' => 'check-circle']);
        $this->addToolbarButton($saveAndContinue, 120000);

        $this->getEventManager()->trigger('init', $this);
    }

    public function setPostData($data)
    {
        if (!$this->passwordRequired) {
            if (empty($data['password'])) {
                $this->remove('password');
                $this->remove('passwordVerify');
            }
        }
        return $this->setData($data);
    }


    public function makePasswordRequired()
    {
        $this->passwordRequired = true;
        return $this;
    }

    public function makePasswordOptional()
    {
        $this->passwordRequired = false;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof UserEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\User\Spec\UserEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function getData($flag = FormInterface::VALUES_NORMALIZED)
    {
        $account = parent::getData($flag);
        if ($account instanceof UserEntity) {
            $inputFilter = $this->getInputFilter();
            $raw = $inputFilter->getRawValues();
            if (empty($raw['roles'])) {
                $account->getRoles()->clear();
            }
        }
        return $account;
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof UserEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\User\Spec\UserEntity'
            );
        }
        return parent::setObject($object);
    }
}
