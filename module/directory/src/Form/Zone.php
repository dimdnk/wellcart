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
use WellCart\Directory\Spec\ZoneEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Zone extends AbstractForm
{

    /**
     * Form constructor
     *
     * @param Factory        $factory
     * @param ObjectHydrator $hydrator
     * @param array          $countryIdOptions
     */
    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        array $countryIdOptions
    ) {
        $this->setFormFactory($factory);

        parent::__construct('directory_zone');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $this->add(
            [
                'name'       => 'country',
                'type'       => 'Select',
                'options'    => [
                    'label'            => __('Country'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                    'empty_option'     => __('- Select Country -'),
                    'value_options'    => $countryIdOptions,
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'directory_zone_country',
                    'class'        => 'chosen-element',
                ],
            ],
            ['priority' => 700]
        );

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
                    'id'    => 'directory_zone_status',
                    'class' => 'icheck-element',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'name',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Zone Name'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'        => 'directory_zone_name',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'code',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Zone Code'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'directory_zone_code',
                ],
            ],
            ['priority' => 550]
        );


        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'directory_zone_csrf',
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

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof ZoneEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\ZoneEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof ZoneEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\ZoneEntity'
            );
        }
        return parent::setObject($object);
    }
}
