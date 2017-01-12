<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductI18nRepository;
use WellCart\ORM\AbstractRepository;

class ProductI18n extends AbstractRepository implements ProductI18nRepository
{

    /**
     * @return ProductI18nQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('ProductI18nEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return ProductI18nQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new ProductI18nQuery($this->_em))
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
     * @param $id
     *
     * @return null|ProductEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findProductById($id)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('id')
        );

        return $this->getEntityManager()
            ->find(
                'WellCart\Catalog\Spec\ProductEntity',
                (int)$id
            );
    }

    /**
     * Create new product entity
     *
     * @return ProductEntity
     */
    public function createProductEntity()
    {
        return $this->getEntityManager()
            ->getRepository('WellCart\Catalog\Spec\ProductEntity')
            ->createEntity();
    }

    /**
     * @inheritDoc
     */
    public function findAllProductIds(): array
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this
        );

        return $this->getEntityManager()
            ->getRepository('WellCart\Catalog\Spec\ProductEntity')
            ->findAllIds();
    }
}
