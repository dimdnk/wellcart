<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Form\OAuth2;

use WellCart\RestApi\Entity\OAuth2\Client as ClientEntity;
use WellCart\RestApi\Exception;
use WellCart\RestApi\Hydrator\OAuth2\ClientHydrator;
use WellCart\Ui\Form\LinearForm as AbstractForm;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Client extends AbstractForm
{
    /**
     * Canonical form name
     */
    const NAME = 'api_client';

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
        parent::__construct(static::NAME);
        $this->setHydrator($hydrator);
        $this->setWrapElements(true);

        $this->add(
            [
                'name'       => 'user',
                'type'       => 'userAccountsSelector',
                'options'    => [
                    'label' => __('User'),
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
                    'label' => __('ID'),
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
                    'label'      => __('Secret'),
                    'help-block' => __('Minimum 6 chars'),

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
                    'help-block'          => __('Repeat new secret'),
                    'strokerform-exclude' => false,
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
                    'label'      => __('Redirect URI'),
                    'help-block' => __('Optional'),
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
