<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeValueI18nRepository;
use WellCart\ORM\AbstractRepository;

class AttributeValueI18n extends AbstractRepository
    implements AttributeValueI18nRepository
{

    /**
     * @return AttributeValueI18nQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('AttributeI18nEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return AttributeValueI18nQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new AttributeValueI18nQuery($this->_em))
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
     * @return null|AttributeEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findAttributeById($id)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('id')
        );

        return $this->getEntityManager()
            ->find(
                'WellCart\Catalog\Spec\AttributeEntity',
                (int)$id
            );
    }
}
