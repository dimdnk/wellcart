<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WellCart\Admin\Exception\UnprocessableEntityException;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\Utility\Arr;

class RoleEntityListener
{

    public function preUpdate(
        AclRoleEntity $role,
        LifecycleEventArgs $args
    ) {
        $changeSet = $args->getObjectManager()
            ->getUnitOfWork()
            ->getEntityChangeSet($role);
        $name = Arr::get($changeSet, 'name.0');
        if ($name === 'admin' || $name === 'superadmin') {
            throw new UnprocessableEntityException(
                'Backend role name used for control panel access & cannot be changed.'
            );
        }
    }

    public function preRemove(AclRoleEntity $role)
    {
        if ($role->getName() == 'admin'
            || $role->getName() == 'superadmin'
        ) {
            throw new UnprocessableEntityException(
                'Backend role cannot be deleted.'
            );
        }
    }
}
