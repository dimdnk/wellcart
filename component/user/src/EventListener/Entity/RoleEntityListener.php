<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener\Entity;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\User\Exception\UnprocessableEntityException;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\User\Spec\AclRoleRepository;

class RoleEntityListener
{

    public function postPersist(
        AclRoleEntity $role,
        LifecycleEventArgs $args
    ) {
        $this->ensureDefaultRole($role, $args);
    }

    protected function ensureDefaultRole(
        AclRoleEntity $role,
        LifecycleEventArgs $args
    ) {
        /**
         * @var $repository AclRoleRepository
         */
        $repository = $args->getObjectManager()->getRepository(
            'WellCart\User\Spec\AclRoleEntity'
        );
        $repository->ensureDefaultRole($role);
    }

    public function postUpdate(
        AclRoleEntity $role,
        LifecycleEventArgs $args
    ) {
        $this->ensureDefaultRole($role, $args);
    }

    public function preRemove(AclRoleEntity $role)
    {
        if ($role->isDefault()) {
            throw new UnprocessableEntityException(
                'Default role cannot be deleted.'
            );
        }
    }
}
