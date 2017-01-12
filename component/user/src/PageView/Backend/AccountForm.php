<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\PageView\Backend;

use WellCart\Backend\PageView\Form\Standard;
use WellCart\ORM\Entity;
use WellCart\User\Exception;
use WellCart\User\Spec\UserEntity;
use WellCart\User\Spec\UserRepository;

class AccountForm extends Standard
{

    public function __construct(
        UserRepository $repository,
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
        $this->addLayoutHandle('user/accounts/form');
        $this->setPageTitle(__('User Accounts'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Users'),
                        'route'  => 'zfcadmin/user/accounts',
                        'params' => [],
                    ],
                ]
            );

        $entity = $this->getEntity();
        if ($entity->getId() > 0) {
            $this->addLayoutHandle('user/accounts/form/update');
            $this->setFormTitle(
                sprintf(
                    __('Edit user account: %s'),
                    e($entity->getEmail())
                )
            );
        } else {
            $this->addLayoutHandle('user/accounts/form/create');
            $this->setFormTitle(
                sprintf(
                    __('Register user account %s'),
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
        if (!$entity instanceof UserEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\User\Spec\UserEntity'
            );
        }

        return parent::setEntity($entity);
    }
}
