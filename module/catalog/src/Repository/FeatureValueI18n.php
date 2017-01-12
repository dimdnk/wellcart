<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureValueI18nRepository;
use WellCart\ORM\AbstractRepository;

class FeatureValueI18n extends AbstractRepository
    implements FeatureValueI18nRepository
{

    /**
     * @return FeatureValueI18nQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('FeatureI18nEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return FeatureValueI18nQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new FeatureValueI18nQuery($this->_em))
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
     * Find option by id
     *
     * @param $id
     *
     * @return null|FeatureEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findFeatureById($id)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('id')
        );

        return $this->getEntityManager()
            ->find(
                'WellCart\Catalog\Spec\FeatureEntity',
                (int)$id
            );
    }
}
