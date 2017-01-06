<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Form\OAuth2;

use WellCart\Form\Form as AbstractForm;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\RestApi\Entity\OAuth2\Scope as ScopeEntity;
use WellCart\RestApi\Exception;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Scope extends AbstractForm
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
        parent::__construct('api_scope');
        $this->setHydrator($hydrator);
        $this->setWrapElements(true);

        $this->add(
            [
                'name'       => 'is_default',
                'type'       => 'checkbox',
                'options'    => [
                    'label'               => __('Default Scope'),
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
                    'id'    => 'api_scope_is_default',
                    'class' => 'switchery-element',
                    'value' => 0,
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'scope',
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
                    'id' => 'api_scope_scope',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'api_scope_csrf',
                ],
            ],
            ['priority' => 450]
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
            ->setLabel(__('Save & Continue Edit'));
        $this->addToolbarButton($saveAndContinue, 120000);

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof ScopeEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\OAuth2\Scope'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof ScopeEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\OAuth2\Scope'
            );
        }
        return parent::setObject($object);
    }
}
