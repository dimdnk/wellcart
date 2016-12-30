<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Repository\Acl;

use WellCart\ORM\AbstractRepository;
use WellCart\User\Spec\AclPermissionRepository;

class Permissions extends AbstractRepository implements AclPermissionRepository
{

    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $permissions = $this->finder()->orderByName()->findAll();
        foreach ($permissions as $permission) {
            $optionList[$permission->getId()] = $permission->getName();
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('optionsList')
        );
        return $optionList;
    }

    /**
     * @return PermissionsQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('PermissionEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return PermissionsQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new PermissionsQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );
        return $queryBuilder;
    }
}
