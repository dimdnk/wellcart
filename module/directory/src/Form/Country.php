<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Form;

use WellCart\Directory\Exception;
use WellCart\Directory\Spec\CountryEntity;
use WellCart\Ui\Form\LinearForm as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Country extends AbstractForm
{
    /**
     * Canonical form name
     */
    const NAME = 'directory_country';
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
        parent::__construct(static::NAME);

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $this->add(
            [
                'name'       => 'status',
                'type'       => 'checkbox',
                'options'    => [
                    'label'               => __('Is Enabled'),
                    'strokerform-exclude' => true,
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id' => 'directory_country_status',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Name'),
                ],
                'attributes' => [
                    'id' => 'directory_country_name',
                ],
            ],
            ['priority' => 650]
        );


        $this->add(
            [
                'name'       => 'iso_code2',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('ISO Code (2)'),

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
                    'label' => __('ISO Code (3)'),
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
                    'label' => __('Address Format'),
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
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id' => 'directory_country_postcode_required',
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
                'name'    => 'save',
                'type'    => 'Submit',
                'options' => [
                    'label' => __('Save'),
                ],
            ]
        );

        $saveAndContinue = clone $this->get('save');
        $saveAndContinue
            ->setName('save_and_continue_edit')
            ->setLabel(__('Save & Continue Edit'));
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
