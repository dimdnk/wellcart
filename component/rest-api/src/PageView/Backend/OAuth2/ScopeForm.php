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
use WellCart\RestApi\Entity\OAuth2\Scope as ScopeEntity;
use WellCart\RestApi\Exception;
use WellCart\RestApi\Repository\OAuth2\Scopes;

class ScopeForm extends Standard
{
    public function __construct(
        Scopes $repository,
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

        $this->addLayoutHandle('api/oauth2-scopes/form');
        $this->setPageTitle(__('Scopes'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Scopes'),
                        'route'  => 'zfcadmin/api/oauth2-scopes',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('api/oauth2-scopes/form/update');
            $this->setFormTitle(
                sprintf(__('Edit scope: %s'), e($entity->getScope()))
            );
        } else {
            $this->addLayoutHandle('api/oauth2-scopes/form/create');
            $this->setFormTitle(
                sprintf(__('Create scope %s'), e($entity->getScope()))
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof ScopeEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\RestApi\Entity\OAuth2\Scope'
            );
        }

        return parent::setEntity($entity);
    }
}
