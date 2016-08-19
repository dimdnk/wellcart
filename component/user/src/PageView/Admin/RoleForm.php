<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\PageView\Admin;

use WellCart\Admin\PageView\Form\Standard;
use WellCart\ORM\Entity;
use WellCart\User\Exception;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\User\Spec\AclRoleRepository;

class RoleForm extends Standard
{
    public function __construct(
        AclRoleRepository $repository,
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
        $this->addLayoutHandle('user/roles/form');
        $this->setPageTitle(__('User Roles'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Roles'),
                        'route'  => 'zfcadmin/user/roles',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('user/roles/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit access role settings: %s'),
                    e($entity->getName())
                )
            );
        } else {
            $this->addLayoutHandle('user/roles/form/create');
            $this->setFormTitle(
                sprintf(
                    __('Create new role %s'),
                    e($entity->getName())
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
        if (!$entity instanceof AclRoleEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\User\Spec\AclRoleEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
