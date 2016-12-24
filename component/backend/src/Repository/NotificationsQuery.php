<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Repository;

use WellCart\ORM\QueryBuilder;

class NotificationsQuery extends QueryBuilder
{
    public function read()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isRead = :is_read')
            ->setParameter('is_read', true);
        return $this;
    }

    public function deleted()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isDeleted = :is_deleted')
            ->setParameter('is_deleted', true);
        return $this;
    }

    /**
     * @param int|null $limit
     *
     * @return array
     */
    public function recent(int $limit = 0): array
    {
        $this->defaultScope();
        if ($limit > 0) {
            $this->setMaxResults(abs($limit));
        }

        return $this->getQuery()
            ->getResult();
    }

    public function defaultScope()
    {
        return $this
            ->notRead()
            ->notDeleted()
            ->orderBy($this->getRootAliases()[0] . '.id', 'desc');
    }

    public function notDeleted()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isDeleted = :is_deleted')
            ->setParameter('is_deleted', false);
        return $this;
    }

    public function notRead()
    {
        $this->andWhere($this->getRootAliases()[0] . '.isRead = :is_read')
            ->setParameter('is_read', false);
        return $this;
    }
}
