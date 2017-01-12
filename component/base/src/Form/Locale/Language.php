<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Form\Locale;

use WellCart\Base\Exception;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Language extends AbstractForm
{
    /**
     * Canonical form name
     */
    const NAME = 'base_locale_language';

    /**
     * Form constructor
     *
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
                'name'       => 'is_active',
                'type'       => 'checkbox',
                'options'    => [
                    'label'               => __('Is Active'),
                    'strokerform-exclude' => true,
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id' => 'base_locale_language_is_active',
                ],
            ],
            ['priority' => 800]
        );

        $this->add(
            [
                'name'       => 'is_default',
                'type'       => 'checkbox',
                'options'    => [
                    'label'               => __('Is Primary'),
                    'strokerform-exclude' => true,
                    'use_hidden_element'  => true,
                    'checked_value'       => 1,
                    'unchecked_value'     => 0,
                ],
                'attributes' => [
                    'id' => 'base_locale_language_is_default',
                ],
            ],
            ['priority' => 750]
        );

        $this->add(
            [
                'name'       => 'name',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Name'),
                ],
                'attributes' => [
                    'id' => 'base_locale_language_name',
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
                    'id' => 'base_locale_language_code',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'locale',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Locale'),
                ],
                'attributes' => [
                    'id' => 'base_locale_language_locale',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'territory',
                'type'       => 'Text',
                'options'    => [
                    'label' => __('Territory'),
                ],
                'attributes' => [
                    'id' => 'base_locale_language_territory',
                ],
            ],
            ['priority' => 550]
        );


        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'base_locale_language_csrf',
                ],
            ],
            ['priority' => 100000]
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
        if (!$object instanceof LocaleLanguageEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Base\Spec\LocaleLanguageEntity'
            );
        }

        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof LocaleLanguageEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Base\Spec\LocaleLanguageEntity'
            );
        }

        return parent::setObject($object);
    }
}
