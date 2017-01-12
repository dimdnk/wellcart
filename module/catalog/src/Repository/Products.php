<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\ProductRepository;
use WellCart\ORM\AbstractRepository;

class Products extends AbstractRepository implements ProductRepository
{

    /**
     * @return ProductsQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('ProductEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return ProductsQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new ProductsQuery($this->_em))
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
