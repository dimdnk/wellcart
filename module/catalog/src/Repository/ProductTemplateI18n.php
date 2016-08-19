<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductTemplateI18nRepository;
use WellCart\ORM\AbstractRepository;
use WellCart\ORM\ExpectedResultException;

class ProductTemplateI18n extends AbstractRepository
    implements ProductTemplateI18nRepository
{

    /**
     * Find group by id
     *
     * @param $id
     *
     * @return null|ProductTemplateEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findProductTemplateById($id)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('id')
        );
        return $this->getEntityManager()
            ->find(
                'WellCart\Catalog\Spec\ProductTemplateEntity',
                (int)$id
            );
    }

    /**
     * Create new product entity
     *
     * @return ProductTemplateEntity
     */
    public function createProductTemplateEntity()
    {
        return $this->getEntityManager()
            ->getRepository(
                'WellCart\Catalog\Spec\ProductTemplateEntity'
            )
            ->createEntity();
    }

    /**
     * Perform group delete objects
     *
     * @param array $ids
     * @param bool  $useException
     *
     * @return array
     * @throws ExpectedResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function performGroupDeleteProductTemplates(
        array $ids,
        $useException = false
    ) {
        $result = [];
        $ids = array_map('abs', array_map('intval', $ids));

        if (empty($ids)) {
            return [];
        }

        $em = $this->getEntityManager();

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('ids', 'em')
        );

        foreach ($ids as $id) {
            $object = $em->find(
                'WellCart\Catalog\Spec\ProductTemplateEntity',
                $id
            );
            if ($object !== null) {
                $this->_em->remove($object);
                $result[] = $ids;
            }
        }
        $this->_em->flush();

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('result', 'em', 'ids')
        );
        if ($useException) {
            throw new ExpectedResultException(
                'Records successfully removed from database.'
            );
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $groupI18n = $this->finder()->findAll();
        foreach ($groupI18n as $attribute) {
            $name = $attribute->getName();
            $optionList[$attribute->getId()] = $name;
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('featuresList')
        );
        return $optionList;
    }

    /**
     * {@inheritDoc}
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('ProductTemplateI18nEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * {@inheritDoc}
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new ProductTemplateI18nQuery($this->_em))
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
     * @inheritDoc
     */
    public function findAllTemplateIds(): array
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this
        );
        return $this->getEntityManager()
            ->getRepository('WellCart\Catalog\Spec\ProductTemplateEntity')
            ->findAllIds();
    }
}
