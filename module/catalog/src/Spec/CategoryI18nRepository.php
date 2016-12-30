<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

use WellCart\ORM\QueryBuilder;
use WellCart\ORM\Repository;

interface CategoryI18nRepository extends Repository
{

    /**
     * Creates a new QueryBuilder instance with predefined root alias.
     *
     * @return QueryBuilder
     */
    public function finder();

    /**
     * Creates a new QueryBuilder instance.
     *
     * @param  string     $alias
     * @param null|string $indexBy
     *
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null);

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
    public function findCategoryById($id);

    /**
     * Create new category entity
     *
     * @return CategoryEntity
     */
    public function createCategoryEntity();

    /**
     * @return array
     */
    public function findAllCategoryIds(): array;
}
