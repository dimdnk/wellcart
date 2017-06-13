<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductTemplateRepository;
use WellCart\ORM\AbstractRepository;
use WellCart\ORM\ExpectedResultException;

class ProductTemplates extends AbstractRepository
    implements ProductTemplateRepository
{

    /**
     * @inheritdoc
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $productTemplates = $this->finder()->findAll();
        foreach ($productTemplates as $attribute) {
            $name = $attribute->getTranslations()->current()->getName();
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
     * @return ProductTemplatesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('ProductTemplateEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );

        return $finder;
    }

    /**
     * @return ProductTemplatesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new ProductTemplatesQuery($this->_em))
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
     * @inheritdoc
     */
    public function findPrimary()
    {
        return $this->findOneBy(['isSystem' => true]);
    }

    /**
     * @param $id
     *
     * @return null|object
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
     * @return ProductTemplateEntity
     */
    public function createProductTemplateEntity()
    {
        return $this->getEntityManager()
            ->getRepository(ProductTemplateEntity::class)
            ->createEntity();
    }

    /**
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
            compact('em', 'ids')
        );

        foreach ($ids as $id) {
            $object = $em->find(
                ProductTemplateEntity::class,
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
            compact('result', 'ids')
        );

        if ($useException) {
            throw new ExpectedResultException(
                'Records successfully removed from database.'
            );
        }
    }
}
