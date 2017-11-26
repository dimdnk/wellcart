<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\PageView\Grid;

use WellCart\Backend\PageView\EntityPageView;
use WellCart\ORM\QueryBuilder;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareTrait;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Controller\Plugin\GridFilterBuilder;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\PriorityList;

abstract class Standard
    extends EntityPageView
    implements
    Datagrid\PageViewInterface,
    ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * Canonical grid name
     */
    const NAME = 'backend_grid';

    /**
     * Default layout handle for grid
     */
    protected $layout = 'ui/grid/standard';

    protected $idFieldName = 'id';

    /**
     * @var Datagrid\Datagrid
     */
    protected $grid;

    /**
     * @var PriorityList
     */
    protected $columns;

    /**
     * @var PriorityList
     */
    protected $toolbarActions;

    /**
     * @var PriorityList
     */
    protected $groupActions;

    /**
     * @var array
     */
    protected $defaultOrder = ['sortBy' => 'id', 'sortOrder' => 'asc'];


    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template = 'wellcart-backend/page-view/grid/standard/layout';

    protected $limitPerPage = 20;

    protected $uiConfigKey;

    /**
     * @inheritDoc
     */
    public function __construct($variables, $options)
    {
        $this->columns = new PriorityList;
        $this->columns->isLIFO(false);
        $this->toolbarActions = new PriorityList;
        $this->toolbarActions->isLIFO(false);
        $this->groupActions = new PriorityList;
        $this->groupActions->isLIFO(false);
        parent::__construct($variables, $options);
    }


    /**
     * @param Datagrid\ToolbarAction $button
     *
     * @return $this
     */
    public function addToolbarAction(Datagrid\ToolbarAction $button)
    {
        $this->toolbarActions->insert($button->getName(), $button);

        return $this;
    }

    public function getToolbarAction($name)
    {
        return $this->toolbarActions->get($name);
    }

    public function removeToolbarAction($name)
    {
        $this->toolbarActions->remove($name);

        return $this;
    }

    public function getColumn($name)
    {
        return $this->columns->get($name);
    }

    public function removeColumn($name)
    {
        $this->columns->remove($name);

        return $this;
    }

    /**
     * @param Datagrid\GroupAction $button
     *
     * @return $this
     */
    public function addGroupAction(Datagrid\GroupAction $button)
    {
        $this->groupActions->insert($button->getLabel(), $button);

        return $this;
    }

    public function getGroupAction($name)
    {
        return $this->groupActions->get($name);
    }

    public function removeGroupAction($name)
    {
        $this->groupActions->remove($name);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function prepare($template = null, $values = null)
    {
        if ($this->isPrepared()) {
            return $this;
        }

        $this->addLayoutHandle($this->layout, -1);
        $scope = $this->scope();
        $route = $this->getRouteName();

        $this->newGridInstance();
        $this->configureGrid();

        $finder = $this->repository->finder();
        $this->configureQueryBuilder($finder);
        foreach ($this->columns as $col) {
            $this->grid->addColumn($col);
        }
        foreach ($this->toolbarActions as $btn) {
            $this->grid->addToolbarAction($btn);
        }
        foreach ($this->groupActions as $btn) {
            $this->grid->addMassAction($btn);
        }

        /**
         * @var $filterBuilder GridFilterBuilder
         */
        $filterBuilder = $this->getControllerPlugin('gridFilterBuilder');
        $params = $this->getControllerPlugin('params');
        $page = abs((int)$params->fromQuery('page', 1));
        $filters = $filterBuilder->__invoke(
            $scope,
            $finder
        );
        foreach ($this->grid->getColumns() as $col) {
            if ($col->isFilterable()) {
                $filters->add(
                    $col->getUniqueId(),
                    $col->getFilter()['form_element'],
                    $col->getFilter()['expression']
                );
            }
        }
        $filters->getDefaultOrder(
            $this->getDefaultOrder()['sortBy'],
            $this->getDefaultOrder()['sortOrder']
        );

        $filters->applyFilters();
        $paginator = $filters->paginate($page, $this->limitPerPage);
        $data = ArrayUtils::iteratorToArray($paginator, true);

        $idField = $this->idFieldName;
        foreach ($data as &$row) {
            if (!empty($row[$idField])) {
                $row['entity_id'] = $row[$idField];
            }
        }
        $this->grid->setDataSource($data);

        $vars = compact(
            'scope',
            'route',
            'paginator'
        );

        $gridViewModel = $this->grid->getResponse();
        $gridViewModel->setVariables($vars);

        $this->setVariables($vars)
            ->addChild($gridViewModel, 'grid');

        $this->configurePage();


        $pager = $this->getPager();
        if ($pager->isEmpty()) {
            $page = $paginator->getCurrentPageNumber();
            $total = $paginator->count();
            $previous = ($page > 1) ? $page - 1 : null;
            $next = ($page < $total) ? $page + 1 : null;
            if ($previous) {
                $pager->setPreviousUrl(
                    url_to_route(
                        null,
                        [],
                        [
                            'query' => [
                                'page' => $previous,
                            ],
                        ]
                    )
                );
            }
            if ($next) {
                $pager->setNextUrl(
                    url_to_route(
                        null,
                        [],
                        [
                            'query' => [
                                'page' => $next,
                            ],
                        ]
                    )
                );
            }
        }

        return parent::prepare($template, $values);
    }

    /**
     * Current grid scope
     *
     * @return string
     */
    protected function scope()
    {
        return static::NAME;
    }

    /**
     * Current route name
     *
     * @return string
     */
    abstract public function getRouteName();

    /**
     * Grid factory
     *
     * @return void
     */
    final protected function newGridInstance()
    {
        /* @var $grid \WellCart\Ui\Datagrid\Datagrid */
        $grid = $this->getServiceLocator()->get('ZfcDatagrid\Datagrid');

        $this->setId(static::NAME);
        $grid->setTitle('Standard Backend Grid');
        $grid->setRendererName('HtmlDataGrid');
        $grid->setToolbarTemplate(
            'wellcart-backend/page-view/grid/standard/header-toolbar'
        );

        $col = new Datagrid\Column('entity_id');
        $col->setIdentity();
        $col->setSortable(false);
        $this->addColumn($col);

        $col = new Datagrid\Column($this->idFieldName);
        $col->setLabel('ID');
        $col->setWidth(5);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'eq');
        $this->addColumn($col);

        $this->grid = $grid;
    }

    /**
     * @inheritdoc
     */
    final public function setId($id)
    {
        if ($this->grid !== null) {
            $this->grid->setId($id);
        }
        parent::setId($id);
    }

    /**
     * @param $column
     *
     * @return Standard
     */
    public function addColumn($column)
    {
        $this->columns->insert($column->getUniqueId(), $column);

        return $this;
    }

    /**
     * Configure Data Grid
     *
     * @return void
     */
    public function configureGrid()
    {
        $this->getEventManager()
            ->trigger(
                __FUNCTION__,
                $this,
                ['grid' => $this->grid]
            );
    }

    /**
     * Initialize query builder
     *
     * @param QueryBuilder $qb
     */
    public function configureQueryBuilder(QueryBuilder $qb)
    {
        $qb->setCacheable(true);
        $this->getEventManager()
            ->trigger(__FUNCTION__, $this);
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
     * @return Standard
     */
    public function setDefaultOrder($sortBy, $sortOrder = 'asc')
    {
        $this->defaultOrder = [
            'sortBy'    => $sortBy,
            'sortOrder' => $sortOrder,
        ];

        return $this;
    }

    /**
     * Configure page variables
     *
     * @return void
     */
    public function configurePage()
    {
        $this->getEventManager()
            ->trigger(__FUNCTION__, $this);
    }

    public function getUiConfigKey()
    {
        return $this->uiConfigKey ?? $this->getId();
    }

    public function setUiConfigKey(string $uiConfigKey)
    {
        $this->uiConfigKey = $uiConfigKey;
        return $this;
    }
}
