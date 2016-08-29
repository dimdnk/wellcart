<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\CategoryEntity;
use WellCart\Catalog\Spec\CategoryI18nRepository;
use WellCart\ORM\AbstractRepository;

class CategoryI18n extends AbstractRepository implements CategoryI18nRepository
{

    /**
     * @return CategoryI18nQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('CategoryI18nEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return CategoryI18nQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new CategoryI18nQuery($this->_em))
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
     * Find category by id
     *
     * @param $id
     *
     * @return null|CategoryEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findCategoryById($id)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('id')
        );

        $repository = $this->getEntityManager()
            ->getRepository(
                'WellCart\Catalog\Spec\CategoryEntity'
            );

        return $repository
            ->findOneExcludeRoot($id);
    }

    /**
     * Create new category entity
     *
     * @return CategoryEntity
     */
    public function createCategoryEntity()
    {
        return $this->getEntityManager()
            ->getRepository('WellCart\Catalog\Spec\CategoryEntity')
            ->createEntity();
    }

    /**
     * @inheritDoc
     */
    public function findAllCategoryIds(): array
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this
        );
        return $this->getEntityManager()
            ->getRepository('WellCart\Catalog\Spec\CategoryEntity')
            ->findAllIds();
    }
}
