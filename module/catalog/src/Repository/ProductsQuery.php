<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\ProductEntity;
use WellCart\ORM\QueryBuilder;

class ProductsQuery extends QueryBuilder
{
    public function defaultSortOrder()
    {
        $this->addOrderBy($this->getRootAliases()[0] . '.sortOrder', 'ASC');
        return $this;
    }

    public function enabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.status = :status');
        $this->setParameter('status', ProductEntity::STATUS_ENABLED);
        return $this;
    }

    public function disabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.status = :status');
        $this->setParameter('status', ProductEntity::STATUS_DISABLED);
        return $this;
    }
}
