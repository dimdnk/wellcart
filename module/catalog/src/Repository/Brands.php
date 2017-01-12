<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\BrandRepository;
use WellCart\ORM\AbstractRepository;

class Brands extends AbstractRepository implements BrandRepository
{

    /**
     * @return BrandsQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('BrandEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return BrandsQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new BrandsQuery($this->_em))
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
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $brands = $this->findAll();
        foreach ($brands as $brand) {
            $name = $brand->getName();
            $optionList[$brand->getId()] = $name;
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('featuresList')
        );

        return $optionList;
    }
}
