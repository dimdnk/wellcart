<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Repository;

use WellCart\Backend\Spec\AdministratorRepository;
use WellCart\User\Repository\Users;
use WellCart\User\Spec\AclRoleEntity;

class Administrators extends Users implements AdministratorRepository
{

    /**
     * @param $role
     *
     * @return int
     */
    public function countUsersWithRole($role): int
    {
        if (is_string($role)) {
            /**
             * @var $role AclRoleEntity
             */
            $role = $this->_em->getRepository(AclRoleEntity::class)
                ->findOneByName($role);
            if (is_null($role)) {
                return 0;
            }
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('role')
        );
        $roleId = $role->getId();
        $count = (int)$this->connection()->fetchColumn(
            'SELECT COUNT(*) FROM acl_admin_user_to_role WHERE role_id = :role_id',
            ['role_id' => $roleId]
        );
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('role', 'count')
        );

        return $count;
    }

    /**
     * @inheritDoc
     */
    public function getUserIdsWithRole($role): array
    {
        if (is_string($role)) {
            /**
             * @var $role AclRoleEntity
             */
            $role = $this->_em->getRepository(AclRoleEntity::class)
                ->findOneByName($role);
            if (is_null($role)) {
                return [];
            }
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('role')
        );
        $roleId = $role->getId();
        $ids = $this->connection()->fetchArray(
            'SELECT user_id FROM acl_admin_user_to_role WHERE role_id = :role_id',
            ['role_id' => $roleId]
        );
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('role', 'ids')
        );

        return $ids;
    }
}
