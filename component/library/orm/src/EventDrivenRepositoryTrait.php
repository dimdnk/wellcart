<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\ORM;

use Doctrine\ORM\Mapping\ClassMetadata;
use WellCart\Utility\Str;
use Zend\Paginator\Paginator;

trait EventDrivenRepositoryTrait
{

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
    ) {
        $methodName = Str::underscored2camel(
            'perform_group_' . str_replace('-', '_', $actionName)
        );
        if (!method_exists($this, $methodName)) {
            throw new \BadMethodCallException(
                "Undefined method " . get_class($this) . "::$methodName called."
            );
        }

        $ids = array_map('abs', array_map('intval', $ids));
        $this->getEventManager()
            ->trigger(
                __FUNCTION__ . '.pre', $this,
                compact('actionName', 'selectionType', 'ids', 'methodName')
            );

        ignore_user_abort(true);
        set_time_limit(0);
        $result = $this->$methodName($ids, $useException);
        ini_restore('max_execution_time');

        return $result;
    }

    /**
     * Perform group delete objects
     *
     * @param array $ids
     * @param bool  $useException
     *
     * @return array
     * @throws ExpectedResultException
     */
    public function performGroupDelete(
        array $ids, $useException = false
    ) {
        $result = [];
        $ids = array_map('abs', array_map('intval', $ids));

        if (empty($ids)) {
            return [];
        }
        foreach ($ids as $id) {
            $object = $this->find($id);
            if ($object !== null) {
                $this->_em->remove($object);
                $result[] = $ids;
            }
        }
        $this->_em->flush();
        if ($useException) {
            throw new ExpectedResultException(
                'Records successfully removed from database.'
            );
        }

        return $result;
    }

    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed    $id          The identifier.
     * @param int      $lockMode    The lock mode.
     * @param int|null $lockVersion The lock version.
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre', $this,
            compact('id', 'lockMode', 'lockVersion')
        );
        $result = parent::find($id, $lockMode, $lockVersion);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post', $this,
            compact('id', 'lockMode', 'lockVersion', 'result')
        );

        return $result;
    }

    /**
     * Clears the repository, causing all managed entities to become detached.
     *
     * @return void
     */
    public function clear()
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);
        parent::clear();
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this);
    }

    /**
     * Finds all entities in the repository.
     *
     * @return array The entities.
     */
    public function findAll()
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);
        $result = parent::findAll();
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post', $this, compact('result')
        );

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        return (new QueryBuilder($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);
    }

    /**
     * Retrieve the "count" result of the query.
     *
     * @return int
     */
    public function count()
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);

        return $this->finder()->count();
    }

    /**
     * Creates a new QueryBuilder instance.
     *
     * @return QueryBuilder
     */
    abstract public function finder();

    /**
     * Retrieve the minimum value of a given column.
     *
     * @param string $column
     *
     * @return mixed
     */
    public function min($column)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);

        return $this->finder()->min($column);
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
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);

        return $this->finder()->max($column);
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
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);

        return $this->finder()->sum($column);
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
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);

        return $this->finder()->avg($column);
    }

    /**
     * Finds entity ids
     *
     * @return integer[]
     */
    public function findAllIds(): array
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);

        return $this->finder()->findAllIds();
    }

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
    ) {
        foreach ($criteria as $_col => $value) {
            $col = Str::underscored2camel($_col);
            if ($col != $_col) {
                unset($criteria[$_col]);
                $criteria[$col] = $value;
            }
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre', $this,
            compact(
                'criteria',
                'orderBy',
                'limit',
                'offset'
            )
        );

        $result = parent::findBy($criteria, $orderBy, $limit, $offset);

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post', $this,
            compact(
                'criteria',
                'orderBy',
                'limit',
                'offset',
                'result'
            )
        );

        return $result;
    }

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        foreach ($criteria as $_col => $value) {
            $col = Str::underscored2camel($_col);
            if ($col != $_col) {
                unset($criteria[$_col]);
                $criteria[$col] = $value;
            }
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre', $this,
            compact(
                'criteria',
                'orderBy'
            )
        );

        $result = parent::findOneBy($criteria, $orderBy);

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post', $this,
            compact(
                'criteria',
                'orderBy',
                'result'
            )
        );

        return $result;
    }

    /**
     * Retrieve Class Metadata
     *
     * @return ClassMetadata
     */
    public function classMetadata()
    {
        return $this->_class;
    }

    /**
     * Gets the database connection object used by the EntityManager.
     *
     * @return \Doctrine\DBAL\Connection
     */
    public function connection()
    {
        return $this->_em->getConnection();
    }

    /**
     * Create new entity instance
     *
     * @return Entity
     */
    public function createEntity()
    {
        $className = $this->getClassName();

        return new $className;
    }

    /**
     * Save object
     *
     * @param Entity $entity
     *
     * @return Entity
     */
    public function add(Entity $entity)
    {
        $this->_em->persist($entity);
        return $entity;
    }

    public function findPreviousRecord(Entity $entity)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);

        return $this->_em->getRepository(get_class($entity))
            ->finder()
            ->findPreviousRecord((int)$entity->getId());

    }

    public function findNextRecord(Entity $entity)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);

        return $this->_em->getRepository(get_class($entity))
            ->finder()
            ->findNextRecord((int)$entity->getId());

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
        $queryBuilder = $this->finder();
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre', $this,
            compact('queryBuilder', 'page', 'perPage')
        );

        $paginator = $queryBuilder->paginate($page, $perPage);

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post', $this,
            compact('page', 'perPage', 'paginator')
        );

        return $paginator;
    }
}