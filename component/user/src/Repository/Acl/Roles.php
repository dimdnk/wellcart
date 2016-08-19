<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Repository\Acl;

use WellCart\ORM\AbstractRepository;
use WellCart\User\Exception\DomainException;
use WellCart\User\Spec\AclRoleEntity;
use WellCart\User\Spec\AclRoleRepository;

class Roles extends AbstractRepository implements AclRoleRepository
{

    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $roles = $this->finder()->prioritize()->findAll();
        foreach ($roles as $role) {
            $optionList[$role->getId()] = $role->getName();
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('optionsList')
        );
        return $optionList;
    }

    /**
     * @return RolesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('RoleEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return RolesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new RolesQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );
        return $queryBuilder;
    }

    /**
     * Handle default role
     *
     * @param AclRoleEntity $role
     *
     * @return AclRoleEntity
     */
    public function ensureDefaultRole(AclRoleEntity $role)
    {
        $isDefault = $role->isDefault();
        if (!$isDefault) {
            $default = $this->findDefaultRole();
            if (is_null($default)) {
                throw new DomainException('Default role not assigned.');
            }
        } else {
            $this->connection()->executeQuery(
                'UPDATE acl_roles SET is_default = :is_default WHERE role_id != :id',
                ['is_default' => '0', 'id' => $role->getId()]
            );
        }

        return $role;
    }

    /**
     * Find default role
     *
     * @return null|AclRoleEntity
     */
    public function findDefaultRole()
    {
        return $this->findOneBy(['isDefault' => true]);
    }
}
