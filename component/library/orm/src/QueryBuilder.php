<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\ORM;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder as AbstractQueryBuilder;
use WellCart\ORM\Paginator\Adapter\DoctrinePaginator;
use WellCart\ORM\Tools\Pagination\Paginator as ORMPaginator;
use WellCart\Stdlib\ArrayableInterface;
use WellCart\Stdlib\Collection\ArrayCollection;
use WellCart\Stdlib\JsonableInterface;
use Zend\Paginator\Paginator;
use Zend\Stdlib\JsonSerializable;

class QueryBuilder extends AbstractQueryBuilder
    implements ArrayableInterface, JsonableInterface, JsonSerializable
{

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return object The object.
     */
    public function find($id)
    {
        $this->andWhere($this->getRootAliases()[0] . '.id = ' . intval($id));

        return $this->findOne();
    }

    /**
     * Finds a single object by a set of criteria.
     *
     * @return object The object.
     */
    public function findOne()
    {
        $this->setFirstResult(0)
            ->setMaxResults(1);
        $arr = $this->getQuery()
            ->execute();

        return current($arr);
    }

    /**
     * Finds previous record.
     *
     * @param int $id The identifier.
     *
     * @return object The object.
     */
    public function findPreviousRecord($id)
    {
        $this->andWhere($this->getRootAliases()[0] . '.id < ' . intval($id));

        return $this->findOne();
    }

    /**
     * Finds next record.
     *
     * @param int $id The identifier.
     *
     * @return object The object.
     */
    public function findNextRecord($id)
    {
        $this->andWhere($this->getRootAliases()[0] . '.id > ' . intval($id));

        return $this->findOne();
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toArray()
    {
        return $this->findAll()->toArray();
    }

    /**
     * Finds all objects in the repository.
     *
     * @return Collection
     */
    public function findAll()
    {
        return new ArrayCollection(
            $this->getQuery()
                ->execute()
        );
    }

    /**
     * Convert the entity instance to JSON.
     *
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 1)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Retrieve the "count" result of the query.
     *
     * @return int
     */
    public function count()
    {
        $paginator = new ORMPaginator($this);

        return count($paginator);
    }

    /**
     * Retrieve the minimum value of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function min($column)
    {
        $prefix = $this->getRootAliases()[0];
        $this->select("MIN({$prefix}.{$column}) AS min_{$column}");

        return $this->getQuery()->getSingleScalarResult();
    }

    /**
     * Finds entity ids
     *
     * @return integer[]
     */
    public function findAllIds(): array
    {
        $prefix = $this->getRootAliases()[0];
        $this->select("{$prefix}.id");
        $ids = array_column($this->getQuery()->getScalarResult(), 'id');

        return array_map('intval', $ids);
    }

    /**
     * @param $field
     * @param $value
     *
     * @return int
     */
    public function countObjectsWithValue($field, $value)
    {
        $prefix = $this->getRootAliases()[0];

        return $this->setMaxResults(1)
            ->where("{$prefix}.{$field} = :checked_value")
            ->setParameter('checked_value', (string)$value)
            ->count();
    }

    /**
     * Retrieve the maximum value of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function max($column)
    {
        $prefix = $this->getRootAliases()[0];
        $this->select("MAX({$prefix}.{$column}) AS max_{$column}");

        return $this->getQuery()->getSingleScalarResult();
    }

    /**
     * Retrieve the sum of the values of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function sum($column)
    {
        $prefix = $this->getRootAliases()[0];
        $this->select("SUM({$prefix}.{$column}) AS sum_{$column}");

        return $this->getQuery()->getScalarResult();
    }

    /**
     * Retrieve the average of the values of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function avg($column)
    {
        $prefix = $this->getRootAliases()[0];
        $this->select("AVG({$prefix}.{$column}) AS avg_{$column}");

        return $this->getQuery()->getSingleScalarResult();
    }

    /**
     * Retrieve paginator
     *
     * @param int $page
     * @param int $perPage
     *
     * @return Paginator
     */
    public function paginate(int $page = 1, int $perPage = 50): Paginator
    {
        $page = abs(intval($page));
        $perPage = abs(intval($perPage));

        $paginator = new Paginator(
            new DoctrinePaginator(
                new ORMPaginator($this, false)
            )
        );
        $paginator->setCurrentPageNumber($page)
            ->setItemCountPerPage($perPage);

        return $paginator;
    }
}