<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Spec;

use WellCart\ORM\QueryBuilder;

interface PageI18nRepository
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
     * Find page by id
     *
     * @param $id
     *
     * @return null|PageEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findPageById($id);

    /**
     * Create new product entity
     *
     * @return PageEntity
     */
    public function createPageEntity();

    /**
     * Perform group delete objects
     *
     * @param array $ids
     * @param bool  $useException
     *
     * @return mixed
     */
    public function performGroupDeletePages(
        array $ids,
        $useException = false
    );

    /**
     * @return array
     */
    public function findAllPageIds(): array;
}
