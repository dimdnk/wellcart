<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\PageView\Backend;

use WellCart\Backend\Exception;
use WellCart\Backend\PageView\Form\Standard;
use WellCart\Backend\Spec\AdministratorEntity;
use WellCart\Backend\Spec\AdministratorRepository;
use WellCart\ORM\Entity;

class AccountForm extends Standard
{

    public function __construct(
        AdministratorRepository $repository,
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

        $this->addLayoutHandle('admin/accounts/form');

        $this->setPageTitle(__('Administrators'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Administrators'),
                        'route'  => 'backend/admin/accounts',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('admin/accounts/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit administrator account: %s'),
                    e($entity->getEmail())
                )
            );
        } else {
            $this->addLayoutHandle('admin/accounts/form/create');
            $this->setFormTitle(
                sprintf(
                    __('Register administrator account %s'),
                    e($entity->getEmail())
                )
            );
        }

        return parent::prepare($template, $values);
    }

    /**
     * @inheritdoc
     */
    public function setEntity(Entity $entity)
    {
        if (!$entity instanceof AdministratorEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Backend\Spec\AdministratorEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
