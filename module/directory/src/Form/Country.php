<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Form;

use WellCart\Directory\Exception;
use WellCart\Directory\Spec\CountryEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Country extends AbstractForm
{

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
        parent::__construct('directory_country');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $this->add(
            [
                'name'       => 'status',
                'type'       => 'checkbox',
                'options'    => [
                    'label'               => __('Is Enabled'),
                    'strokerform-exclude' => true,
                    'twb-layout'          => 'horizontal',
                    'column-size'         => 'md-12',
                    'label_attributes'    => [
                        'class' => 'col-md-8 col-md-offset-4',
                    ],
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id'    => 'directory_country_status',
                    'class' => 'icheck-element',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'name',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Name'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'        => 'directory_country_name',
                ],
            ],
            ['priority' => 650]
        );


        $this->add(
            [
                'name'       => 'iso_code2',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('ISO Code (2)'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'       => 'directory_country_iso_code2',
                    'required' => 'required',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'iso_code3',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('ISO Code (3)'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'       => 'directory_country_iso_code3',
                    'required' => 'required',
                ],
            ],
            ['priority' => 550]
        );

        $this->add(
            [
                'name'       => 'address_format',
                'type'       => 'Textarea',
                'options'    => [
                    'label'            => __('Address Format'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'directory_country_address_format',
                ],
            ],
            ['priority' => 500]
        );

        $this->add(
            [
                'name'       => 'postcode_required',
                'type'       => 'checkbox',
                'options'    => [
                    'label'               => __('Postcode required'),
                    'strokerform-exclude' => true,
                    'twb-layout'          => 'horizontal',
                    'column-size'         => 'md-12',
                    'label_attributes'    => [
                        'class' => 'col-md-8 col-md-offset-4',
                    ],
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id'    => 'directory_country_postcode_required',
                    'class' => 'icheck-element',
                ],
            ],
            ['priority' => 450]
        );


        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'directory_country_csrf',
                ],
            ],
            ['priority' => 400]
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

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof CountryEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\CountryEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof CountryEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\CountryEntity'
            );
        }
        return parent::setObject($object);
    }
}
