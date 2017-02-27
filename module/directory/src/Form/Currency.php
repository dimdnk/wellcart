<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Form;

use WellCart\Directory\Exception;
use WellCart\Directory\Spec\CurrencyEntity;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\Ui\Form\LinearForm as AbstractForm;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Currency extends AbstractForm
{

    /**
     * Canonical form name
     */
    const NAME = 'directory_currency';

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
                'name'       => 'title',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Currency Title'),

                ],
                'attributes' => [
                    'id' => 'directory_currency_title',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'code',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Code'),
                ],
                'attributes' => [
                    'id' => 'directory_currency_code',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'symbol',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Symbol'),
                ],
                'attributes' => [
                    'id' => 'directory_currency_symbol',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'symbol_position',
                'type'       => 'Select',
                'options'    => [
                    'label'         => __('Symbol Position'),
                    'value_options' => [
                        'left'  => __('Left'),
                        'right' => __('Right'),
                    ],
                ],
                'attributes' => [
                    'autocomplete' => 'off',
                    'id'           => 'directory_currency_symbol_position',
                ],
            ],
            ['priority' => 550]
        );

        $this->add(
            [
                'name'       => 'exchange_rate',
                'type'       => 'Text',
                'options'    => [
                    'label'      => __('Exchange Rate'),
                    'help-block' => __(
                        'This rate is to be defined according to your default currency. Primary currency always set to 1.'
                    ),
                ],
                'attributes' => [
                    'id'       => 'directory_currency_exchange_rate',
                    'required' => 'required',
                ],
            ],
            ['priority' => 500]
        );

        $this->add(
            [
                'name'       => 'decimals',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Decimal Places'),
                ],
                'attributes' => [
                    'id' => 'directory_currency_decimals',
                ],
            ],
            ['priority' => 450]
        );

        $this->add(
            [
                'name'       => 'decimals_separator',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Decimals Sign'),
                ],
                'attributes' => [
                    'id'       => 'directory_currency_decimals_separator',
                    'required' => 'required',
                ],
            ],
            ['priority' => 400]
        );

        $this->add(
            [
                'name'       => 'thousands_separator',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Thousands Sign'),
                ],
                'attributes' => [
                    'id'       => 'directory_currency_thousands_separator',
                    'required' => 'required',
                ],
            ],
            ['priority' => 350]
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
                    'id' => 'directory_currency_status',
                ],
            ],
            ['priority' => 300]
        );

        $this->add(
            [
                'name'       => 'is_primary',
                'type'       => 'checkbox',
                'options'    => [
                    'label'               => __('Is Primary'),
                    'strokerform-exclude' => true,
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id' => 'directory_currency_is_primary',
                ],
            ],
            ['priority' => 250]
        );

        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'directory_currency_csrf',
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
        if (!$object instanceof CurrencyEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\CurrencyEntity'
            );
        }

        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof CurrencyEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\CurrencyEntity'
            );
        }

        return parent::setObject($object);
    }
}
