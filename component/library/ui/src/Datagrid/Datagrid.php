<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Ui\Datagrid;

use Zend\Stdlib\PriorityList;
use ZfcDatagrid\Datagrid as DatagridAbstract;
use ZfcDatagrid\PrepareData;

class Datagrid extends DatagridAbstract
{

    /**
     * @var PriorityList
     */
    protected $toolbarButtons;

    public function __construct()
    {
        $this->toolbarButtons = new PriorityList;
        $this->toolbarButtons->isLIFO(false);
    }

    /**
     * @return PriorityList
     */
    public function getToolbarButtons()
    {
        return $this->toolbarButtons;
    }

    public function addToolbarButton(ToolbarButton $button, $priority = 0)
    {
        $this->toolbarButtons->insert(
            $button->getName(), $button, $priority
        );

        return $this;
    }

    public function getToolbarButton($name)
    {
        return $this->toolbarButtons->get($name);
    }

    public function removeToolbarButton($name)
    {
        $this->toolbarButtons->remove($name);

        return $this;
    }

    /**
     * Render the grid
     */
    public function render()
    {
        if ($this->isDataLoaded() === false) {
            $this->loadData();
        }

        /**
         * Step 4) Render the data to the defined output format (HTML, PDF...)
         * - Styling the values based on column (and value)
         */
        $renderer = $this->getRenderer();
        $renderer->setTitle($this->getTitle());
        $renderer->setData($this->preparedData);
        $renderer->prepareViewModel($this);
        $renderer->getViewModel()->setVariable('grid', $this);

        $this->response = $renderer->execute();
        $this->isRendered = true;
    }

    /**
     * Load the data
     */
    public function loadData()
    {
        if (true === $this->isDataLoaded) {
            return true;
        }

        if ($this->isInit() !== true) {
            throw new \Exception(
                'The init() method has to be called, before you can call loadData()!'
            );
        }

        if ($this->hasDataSource() === false) {
            throw new \Exception(
                'No datasource defined! Please call "setDataSource()" first"'
            );
        }

        /**
         * Apply cache
         */
        $renderer = $this->getRenderer();

        /**
         * Step 1) Apply needed columns + filters + sort
         * - from Request (HTML View) -> and save in cache for export
         * - or from cache (Export PDF / Excel) -> same view like HTML (without LIMIT/Pagination)
         */
        {
            /**
             * Step 1.1) Only select needed columns (performance)
             */
            $this->getDataSource()->setColumns($this->getColumns());

            /**
             * Step 1.2) Sorting
             */
            foreach ($renderer->getSortConditions() as $condition) {
                $this->getDataSource()->addSortCondition(
                    $condition['column'], $condition['sortDirection']
                );
            }

            /**
             * Step 1.3) Filtering
             */
            foreach ($renderer->getFilters() as $filter) {
                $this->getDataSource()->addFilter($filter);
            }
        }

        /*
         * Step 2) Load the data (Paginator)
         */
        {
            //$this->getDataSource()->execute();

            $data = $this->getDataSource()->getData();
            if (!is_array($data)) {
                throw new \Exception(
                    'The data source returned an unknown result: %s (allowed: \ArrayIterator or a plain php array)'
                );

            }
        }


        /*
         * Step 3) Format the data - Translate - Replace - Date / time / datetime - Numbers - ...
         */
        $prepareData = new PrepareData($data, $this->getColumns());
        $prepareData->setRendererName($this->getRendererName());
        if ($this->hasTranslator()) {
            $prepareData->setTranslator($this->getTranslator());
        }
        $prepareData->prepare();
        $this->preparedData = $prepareData->getData();

        $this->isDataLoaded = true;
    }
}