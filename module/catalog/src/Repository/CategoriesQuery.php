<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\ORM\QueryBuilder;

class CategoriesQuery extends QueryBuilder
{
    /**
     * @return CategoriesQuery
     */
    public function sortTree()
    {
        $alias = $this->getRootAliases()[0];
        $this->addOrderBy($alias . '.lft', 'ASC');
        return $this;
    }

    public function defaultSortOrder()
    {
        $this->addOrderBy($this->getRootAliases()[0] . '.sortOrder', 'ASC');
        return $this;
    }

    public function visible()
    {
        $this->andWhere(
            $this->getRootAliases()[0] . '.isVisible = :is_visible'
        );
        $this->setParameter('is_visible', 1);
        return $this;
    }

    public function hidden()
    {
        $this->andWhere(
            $this->getRootAliases()[0] . '.isVisible = :is_visible'
        );
        $this->setParameter('is_visible', 0);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function findPreviousRecord($id)
    {
        $this->excludeRoot();
        return parent::findPreviousRecord(
            $id
        );
    }

    /**
     *
     * @return CategoryI18nQuery
     */
    public function excludeRoot()
    {
        $alias = $this->getRootAliases()[0];
        $this->andWhere($this->expr()->andX($alias . '.id <> ' . 1));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function findNextRecord($id)
    {
        $this->excludeRoot();
        return parent::findNextRecord(
            $id
        );
    }


}
