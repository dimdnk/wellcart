<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\ORM\Tools\Pagination;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as AbstractPaginator;

class Paginator extends AbstractPaginator
{

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * Constructor.
     *
     * @param QueryBuilder $queryBuilder        A Doctrine ORM query builder.
     * @param boolean      $fetchJoinCollection Whether the query joins a collection (true by default).
     */
    public function __construct(
        QueryBuilder $queryBuilder, $fetchJoinCollection = true
    ) {
        $this->queryBuilder = $queryBuilder;
        parent::__construct($queryBuilder, $fetchJoinCollection);
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
}
