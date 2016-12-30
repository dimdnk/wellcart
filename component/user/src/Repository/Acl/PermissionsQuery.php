<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Repository\Acl;

use WellCart\ORM\QueryBuilder;

class PermissionsQuery extends QueryBuilder
{
    /**
     * Order by name
     *
     * @return PermissionsQuery
     */
    public function orderByName()
    {
        $alias = $this->getRootAliases()[0];
        $this->addOrderBy($alias . '.name', 'ASC');
        return $this;
    }

    public function systemPermissions()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isSystem = :is_system');
        $this->setParameter('is_system', true);
        return $this;
    }

    public function manageablePermissions()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isSystem = :is_system');
        $this->setParameter('is_system', false);
        return $this;
    }
}
