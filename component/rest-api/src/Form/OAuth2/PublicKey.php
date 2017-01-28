<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Form\OAuth2;

use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\RestApi\Entity\OAuth2\PublicKey as PublicKeyEntity;
use WellCart\RestApi\Exception;
use WellCart\Ui\Form\LinearForm as AbstractForm;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class PublicKey extends AbstractForm
{
    /**
     * Canonical form name
     */
    const NAME = 'api_key';

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

        $this->setHydrator($hydrator);

        $this->setWrapElements(true);
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(
            [
                'name'       => 'client',
                'type'       => 'apiClientSelector',
                'options'    => [
                    'label' => __('Client'),
                ],
                'attributes' => [
                    'id' => 'api_key_client',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'public_key',
                'type'       => 'Text',
                'options'    => [
                    'label'      => __('Public Key'),
                    'help-block' => __('Absolute path on server.'),
                ],
                'attributes' => [
                    'id' => 'api_key_public_key',
                ],
            ],
            ['priority' => 700]
        );

        $this->add(
            [
                'name'       => 'private_key',
                'type'       => 'Text',
                'options'    => [
                    'label'      => __('Private Key'),
                    'help-block' => __('Absolute path on server.'),
                ],
                'attributes' => [
                    'id' => 'api_key_private_key',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'encryption_algorithm',
                'type'       => 'select',
                'options'    => [
                    'label'         => __('Encryption Algorithm'),
                    'empty_option'  => __('- Select Algorithm -'),
                    'value_options' => [
                        'HS256' => 'HS256',
                        'HS384' => 'HS384',
                        'HS512' => 'HS512',
                        'RS256' => 'RS256',
                        'RS384' => 'RS384',
                        'RS512' => 'RS512',
                    ],
                ],
                'attributes' => [
                    'id' => 'api_key_encryption_algorithm',
                ],
            ],
            ['priority' => 600]
        );


        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'api_key_csrf',
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
        if (!$object instanceof PublicKeyEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\PublicKey'
            );
        }

        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof PublicKeyEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\PublicKey'
            );
        }

        return parent::setObject($object);
    }
}
