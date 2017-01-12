<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\CategoryRepository;
use WellCart\ORM\NestedTreeRepository;

class Categories extends NestedTreeRepository implements CategoryRepository
{

    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $categories = $this->finder()->sortTree()->findAll();
        foreach ($categories as $category) {
            $name = $category->getTranslations()->current()->getName();
            $name = str_repeat(' - ', (int)$category->getLvl()) . ' ' . $name;
            $optionList[$category->getId()] = $name;
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('featuresList')
        );

        return $optionList;
    }

    /**
     * @return CategoriesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('CategoryEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return CategoriesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new CategoriesQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );

        return $queryBuilder;
    }

    public function findOneExcludeRoot($id)
    {
        return $this->finder()->excludeRoot()->find($id);
    }
}
