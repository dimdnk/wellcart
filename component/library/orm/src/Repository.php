<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\ORM;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

interface Repository extends ObjectRepository, Selectable
{

    /**
     * Creates a new QueryBuilder instance.
     *
     * @return QueryBuilder
     */
    public function finder();

    /**
     * Save object
     *
     * @param Entity $entity
     *
     * @return Entity
     */
    public function add(Entity $entity);

    /**
     * Create new entity instance
     *
     * @return Entity
     */
    public function createEntity();

    /**
     * Retrieve Class Metadata
     *
     * @return ClassMetadata
     */
    public function classMetadata();

    /**
     * Gets the database connection object used by the EntityManager.
     *
     * @return \Doctrine\DBAL\Connection
     */
    public function connection();

    /**
     * Perform group action
     *
     * @param string $actionName
     * @param array  $ids
     * @param bool   $useException
     *
     * @return mixed
     */
    public function performGroupAction(
        string $actionName,
        array $ids,
        $useException = false
    );

    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed    $id          The identifier.
     * @param int      $lockMode    The lock mode.
     * @param int|null $lockVersion The lock version.
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function find($id, $lockMode = null, $lockVersion = null);

    /**
     * Clears the repository, causing all managed entities to become detached.
     *
     * @return void
     */
    public function clear();

    /**
     * Finds all entities in the repository.
     *
     * @return array The entities.
     */
    public function findAll();

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
     * Retrieve the "count" result of the query.
     *
     * @return int
     */
    public function count();

    /**
     * Retrieve the minimum value of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function min($column);

    /**
     * Retrieve the maximum value of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function max($column);

    /**
     * Retrieve the sum of the values of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function sum($column);

    /**
     * Retrieve the average of the values of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function avg($column);

    /**
     * Finds entity ids
     *
     * @return integer[]
     */
    public function findAllIds(): array;

    /**
     * Finds entities by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array The objects.
     */
    public function findBy(
        array $criteria, array $orderBy = null, $limit = null, $offset = null
    );

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function findOneBy(array $criteria, array $orderBy = null);
}