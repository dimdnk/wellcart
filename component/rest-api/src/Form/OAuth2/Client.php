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
use WellCart\RestApi\Entity\OAuth2\Client as ClientEntity;
use WellCart\RestApi\Exception;
use WellCart\RestApi\Hydrator\OAuth2\ClientHydrator;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Client extends AbstractForm
{

    /**
     * Form constructor
     *
     * @param Factory        $factory
     * @param ClientHydrator $hydrator
     */
    public function __construct(
        Factory $factory,
        ClientHydrator $hydrator
    ) {
        $this->setFormFactory($factory);
        parent::__construct('api_client');
        $this->setHydrator($hydrator);
        $this->setWrapElements(true);

        $this->add(
            [
                'name'       => 'user',
                'type'       => 'userAccountsSelector',
                'options'    => [
                    'label'            => __('User'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'api_client_user',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'client_id',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('ID'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'api_client_client_id',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'new_secret',
                'type'       => 'Password',
                'options'    => [
                    'label'            => __('Secret'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'help-block'       => __('Minimum 6 chars'),
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'api_client_secret',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'new_secret_verify',
                'type'       => 'Password',
                'options'    => [
                    'label'               => __('Secret Verify'),
                    'twb-layout'          => 'horizontal',
                    'column-size'         => 'md-8',
                    'help-block'          => __('Repeat new secret'),
                    'strokerform-exclude' => false,
                    'label_attributes'    => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'api_client_secret_verify',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'redirect_uri',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Redirect URI'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'help-block'       => __('Optional'),
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'api_client_redirect_uri',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'api_client_csrf',
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
        if (!$object instanceof ClientEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\Client'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof ClientEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\Client'
            );
        }
        return parent::setObject($object);
    }

    public function removePasswordElements()
    {
        $this->getEventManager()->trigger('pre.' . __FUNCTION__, $this);
        $this->remove('new_secret');
        $this->remove('new_secret_verify');
        $this->getEventManager()->trigger('post.' . __FUNCTION__, $this);
        return $this;
    }
}
