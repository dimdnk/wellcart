<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Datagrid\Controller\Plugin;

use Doctrine\ORM\QueryBuilder;
use WellCart\Utility\Str;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Paginator\Paginator;


class GridFilterBuilder extends AbstractPlugin
{

    const EQ = 'eq';
    const NEQ = 'neq';
    const LT = 'lt';
    const LTE = 'lte';
    const GT = 'gt';
    const GTE = 'gte';
    const LIKE = 'like';
    const BETWEEN = 'between';
    const RANGE = 'range';

    /**
     * Current scope
     *
     * @var string
     */
    protected $scope;

    /**
     * Scopes
     *
     * @var array
     */
    protected $scopes = [];

    /**
     * @var array
     */
    protected $defaultOrder = ['sortBy' => 'id', 'sortOrder' => 'asc'];

    /**
     * @param              $scope
     * @param QueryBuilder $queryBuilder
     *
     * @return GridFilterBuilder
     */
    public function __invoke($scope, QueryBuilder $queryBuilder = null)
    {
        $this->setScope($scope);
        $isReset = $this->getValue('reset_filters');
        if ($isReset)
        {
            $this->getController()
                ->redirect()
                ->toRoute();
        }
        if ($queryBuilder)
        {
            $this->setQuery($queryBuilder);
        }

        return $this;
    }

    /**
     * @param string $column
     *
     * @return string
     */
    public function getValue($column)
    {
        $values = $this->getValues();

        return (isset($values[$column])) ? $values[$column] : null;
    }

    /**
     * Request values
     *
     * @return array
     */
    public function getValues()
    {
        return (array)$this->getController()
            ->getRequest()
            ->getQuery($this->scope, []);

    }

    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return GridFilterBuilder
     */
    public function setQuery(QueryBuilder $queryBuilder)
    {
        $scope = $this->getScope();
        $this->scopes[$scope] = [
            'query_builder' => $queryBuilder,
            'form_elements' => [],
            'expressions'   => [],
            'values'        => [],
        ];

        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param $scope
     *
     * @return GridFilterBuilder
     */
    public function setScope($scope)
    {
        $this->scope = (string)$scope;

        return $this;
    }

    /**
     * Retrieve scope info
     *
     * @return array
     */
    public function getScopeInfo()
    {
        return $this->scopes[$this->getScope()];
    }

    /**
     * @param $column
     * @param $formElement
     * @param $expression
     *
     * @return GridFilterBuilder
     */
    public function add($column, $formElement, $expression)
    {

        $value = $this->getValue($column);
        if (is_array($value))
        {
            $value = array_map('trim', $value);
            $value = array_map('strip_tags', $value);
        } else
        {
            $value = strip_tags(
                trim((string)$value)
            );
        }

        $this->scopes[$this->scope]['form_elements'][$column] = $formElement;
        $this->scopes[$this->scope]['expressions'][$column] = $expression;
        $this->scopes[$this->scope]['values'][$column] = $value;

        return $this;
    }

    /**
     * @return GridFilterBuilder
     */
    public function applyFilters()
    {
        $request = $this->getController()->getRequest();

        /**
         * @var $queryBuilder QueryBuilder
         */
        $queryBuilder = $this->scopes[$this->scope]['query_builder'];
        $expressions = $this->scopes[$this->scope]['expressions'];
        $values = $this->scopes[$this->scope]['values'];
        $rootAlias = $queryBuilder->getRootAliases()[0] . '.';

        foreach ($expressions as $column => $expression)
        {
            $value = (isset($values[$column])) ? $values[$column] : null;
            if ($value === '' || $value === null)
            {
                continue;
            }
            $this->applyCondition(
                $rootAlias, $expression, $column, $value, $queryBuilder
            );
        }

        $sortOrder = ($request->getQuery(
                'sortOrder', $this->defaultOrder['sortOrder']
            ) == 'desc') ? 'desc'
            : 'asc';
        $sortBy = $request->getQuery('sortBy', $this->defaultOrder['sortBy']);
        if (array_key_exists($sortBy, $expressions))
        {
            $queryBuilder->resetDQLPart('orderBy');
            $sortBy = Str::underscored2camel($sortBy);
            $queryBuilder->orderBy(
                $rootAlias . $sortBy, strtoupper($sortOrder)
            );
        }

        return $this;
    }

    /**
     * @param string       $prefix
     * @param string       $expressionType
     * @param string       $column
     * @param string       $value
     * @param QueryBuilder $queryBuilder
     */
    protected function applyCondition(
        $prefix, $expressionType,
        $column, $value,
        QueryBuilder $queryBuilder
    ) {
        $column = Str::underscored2camel($column);
        if (strpos($column, '.') !== false)
        {
            $prefix = '';
        }
        switch ($expressionType)
        {

            case self::RANGE:
                $start = $end = null;
                if (is_string($value))
                {
                    $arr = explode(' - ', $value);
                    if (count($arr) == 2)
                    {
                        list($start, $end) = $arr;
                    }
                } elseif (is_array($value) && count($value) == 2)
                {
                    $start = current($value);
                    $end = next($value);
                }
                if (!empty($start) && !empty($end))
                {
                    if ($start <= $end)
                    {
                        $_param = preg_replace(
                            "/[^A-Za-z0-9?! ]/", "", $column
                        );
                        $queryBuilder->andWhere(

                            $prefix . $column . ' >= :start_' . $_param .
                            ' AND ' . $prefix . $column . ' <= :end_' . $_param

                        )
                            ->setParameter(
                                ':start_' . $_param, doubleval($start)
                            )
                            ->setParameter(':end_' . $_param, doubleval($end));
                    }
                }

                break;


            case self::BETWEEN:
                $start = $end = null;
                if (is_string($value))
                {
                    $arr = explode(' - ', $value);
                    if (count($arr) == 2)
                    {
                        list($start, $end) = $arr;
                    }
                } elseif (is_array($value) && count($value) == 2)
                {
                    $start = current($value);
                    $end = next($value);
                }
                if (!empty($start) && !empty($end))
                {
                    $queryBuilder->andWhere(
                        $queryBuilder->expr()
                            ->between(
                                $prefix . $column,
                                ':start_' . $column,
                                ':end_' . $column
                            )
                    )
                        ->setParameter('start_' . $column, $start)
                        ->setParameter('end_' . $column, $end);
                }
                break;

            case self::LT:
                $queryBuilder->andWhere(
                    '( ' . $prefix . $column . ' < :' . $column . ' )'
                )
                    ->setParameter($column, $value);
                break;


            case self::LTE:
                $queryBuilder->andWhere(
                    '( ' . $prefix . $column . ' <= :' . $column . ' )'
                )
                    ->setParameter($column, $value);
                break;


            case self::GT:
                $queryBuilder->andWhere(
                    '( ' . $prefix . $column . ' > :' . $column . ' )'
                )
                    ->setParameter($column, $value);
                break;


            case self::GTE:
                $queryBuilder->andWhere(
                    '( ' . $prefix . $column . ' >= :' . $column . ' )'
                )
                    ->setParameter($column, $value);
                break;

            case self::EQ:
                $queryBuilder->andWhere(
                    $queryBuilder->expr()->eq(
                        $prefix . $column, ':' . $column
                    )
                )->setParameter($column, $value);
                break;

            case self::NEQ:
                $queryBuilder->andWhere(
                    $queryBuilder->expr()->neq(
                        $prefix . $column, ':' . $column
                    )
                )->setParameter($column, $value);
                break;

            case self::LIKE:
            default:
                $queryBuilder->andWhere(
                    $queryBuilder->expr()
                        ->like(
                            $prefix . $column,
                            $queryBuilder->expr()->literal($value . '%')
                        )
                );
                break;
        }

    }

    /**
     * @return array
     */
    public function getDefaultOrder()
    {
        return $this->defaultOrder;
    }

    /**
     * @param        $sortBy
     * @param string $sortOrder
     *
     * @return GridFilterBuilder
     */
    public function setDefaultOrder($sortBy, $sortOrder = 'asc')
    {
        $formElements = $this->scopes[$this->scope]['form_elements'];
        if (array_key_exists($sortBy, $formElements))
        {
            $this->defaultOrder = [
                'sortBy'    => $sortBy,
                'sortOrder' => $sortOrder,
            ];
        }

        return $this;
    }

    /**
     * Get paged entities
     *
     * @param int $page
     * @param int $perPage
     *
     * @return Paginator
     */
    public function paginate($page = 1, $perPage = 50)
    {
        $queryBuilder = $this->scopes[$this->scope]['query_builder'];

        return $queryBuilder->paginate($page, $perPage);
    }
}