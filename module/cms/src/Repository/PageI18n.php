<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Repository;

use WellCart\CMS\Spec\PageEntity;
use WellCart\CMS\Spec\PageI18nRepository;
use WellCart\ORM\AbstractRepository;
use WellCart\ORM\ExpectedResultException;

class PageI18n extends AbstractRepository implements PageI18nRepository
{

    /**
     * {@inheritDoc}
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('PageI18nEntity');
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
        $queryBuilder = (new PageI18nQuery($this->_em))
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
     * Find page by id
     *
     * @param $id
     *
     * @return null|PageEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findPageById($id)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('id')
        );

        return $this->getEntityManager()
            ->find('WellCart\CMS\Spec\PageEntity', (int)$id);
    }

    /**
     * Create new product entity
     *
     * @return PageEntity
     */
    public function createPageEntity()
    {
        return $this->getEntityManager()
            ->getRepository('WellCart\CMS\Spec\PageEntity')
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
    public function performGroupDeletePages(
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
            $object = $em->find('WellCart\CMS\Spec\PageEntity', $id);
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
     * @inheritDoc
     */
    public function findAllPageIds(): array
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this
        );

        return $this->getEntityManager()
            ->getRepository(PageEntity::class)
            ->findAllIds();
    }
}
