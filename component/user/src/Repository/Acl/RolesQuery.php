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

class RolesQuery extends QueryBuilder
{

    /**
     * Order by descending isDefault value
     *
     * @return RolesQuery
     */
    public function prioritize()
    {
        $alias = $this->getRootAliases()[0];
        $this->addOrderBy($alias . '.isDefault', 'DESC');
        return $this;
    }

    public function systemRoles()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isSystem = :is_system');
        $this->setParameter('is_system', true);
        return $this;
    }

    public function manageableRoles()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isSystem = :is_system');
        $this->setParameter('is_system', false);
        return $this;
    }

    public function defaultRole()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isDefault = :is_default')
            ->setParameter('is_default', true)
            ->setMaxResults(1);
        return $this;
    }
}
