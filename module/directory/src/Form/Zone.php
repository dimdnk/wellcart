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
use WellCart\Directory\Spec\ZoneEntity;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\Ui\Form\LinearForm as AbstractForm;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Zone extends AbstractForm
{
    /**
     * Canonical form name
     */
    const NAME = 'directory_zone';

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

        parent::__construct(static::NAME);

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $this->add(
            [
                'name'       => 'country',
                'type'       => 'Select',
                'options'    => [
                    'label'         => __('Country'),
                    'empty_option'  => __('- Select Country -'),
                    'value_options' => $countryIdOptions,
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'directory_zone_country',
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
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id' => 'directory_zone_status',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Zone Name'),
                ],
                'attributes' => [
                    'id' => 'directory_zone_name',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'code',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Zone Code'),
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

        $this->addToolbarAction(
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
        $this->addToolbarAction($saveAndContinue, 120000);

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
