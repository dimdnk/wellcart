<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\PageView\Backend\OAuth2;

use WellCart\Admin\PageView\Form\Standard;
use WellCart\ORM\Entity;
use WellCart\RestApi\Entity\OAuth2\Client as ClientEntity;
use WellCart\RestApi\Exception;
use WellCart\RestApi\Repository\OAuth2\Clients;

class ClientForm extends Standard
{

    public function __construct(
        Clients $repository,
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

        $this->addLayoutHandle('api/oauth2-clients/form');

        $this->setPageTitle(__('Clients'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Clients'),
                        'route'  => 'zfcadmin/api/oauth2-clients',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('api/oauth2-clients/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit client: %s'),
                    e($entity->getUser()->getDisplayName())
                )
            );
        } else {
            $this->addLayoutHandle('api/oauth2-clients/form/create');
            $this->setFormTitle(__('Add OAuth2 client'));
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof ClientEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\Client'
            );
        }

        return parent::setEntity($entity);
    }
}
