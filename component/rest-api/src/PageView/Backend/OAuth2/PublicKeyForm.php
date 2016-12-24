<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\PageView\Backend\OAuth2;

use WellCart\Backend\PageView\Form\Standard;
use WellCart\ORM\Entity;
use WellCart\RestApi\Entity\OAuth2\PublicKey as PublicKeyEntity;
use WellCart\RestApi\Exception;
use WellCart\RestApi\Repository\OAuth2\PublicKeys;

class PublicKeyForm extends Standard
{
    public function __construct(
        PublicKeys $repository,
        $variables = null,
        $options = null
    ) {
        $this->setRepository($repository);
        parent::__construct($variables, $options);
    }

    /**
     * @inheritdoc
     */
    public function prepare($template = null, $values = null)
    {
        if ($this->isPrepared()) {
            return $this;
        }

        $this->addLayoutHandle('api/oauth2-public-keys/form');
        $this->setPageTitle(__('Public keys'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Public keys'),
                        'route'  => 'zfcadmin/api/oauth2-public-keys',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('api/oauth2-public-keys/form/update');
            $this->setFormTitle(
                __('Edit public key')
            );
        } else {
            $this->addLayoutHandle('api/oauth2-public-keys/form/create');
            $this->setFormTitle(
                __('Create public key')
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof PublicKeyEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\PublicKey'
            );
        }

        return parent::setEntity($entity);
    }
}
