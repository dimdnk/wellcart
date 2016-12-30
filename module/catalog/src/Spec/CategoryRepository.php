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

interface CategoryRepository extends Repository
{

    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array;

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
}
