<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Form\Element;

use WellCart\Form\Element\Collection;
use WellCart\Utility\Arr;
use Zend\Stdlib\PriorityList;

class TableFieldsetCollection extends Collection
{

    /**
     * @var PriorityList
     */
    protected $columns;

    /**
     * @var PriorityList
     */
    protected $rowActions;

    /**
     * @var string
     */
    protected $caption;

    /**
     * @var array custom options
     */
    protected $options
        = [
            'partial' => 'partial/form/table-fieldset',
        ];

    public function __construct($name = null, $options = [])
    {
        $this->columns = new PriorityList();
        $this->columns->isLIFO(false);

        $this->rowActions = new PriorityList();
        $this->rowActions->isLIFO(false);

        parent::__construct($name, $options);
    }

    public function setOptions($options)
    {
        $options = Arr::merge($this->options, $options);
        parent::setOptions(
            $options
        );
        if (isset($options['columns'])) {
            $this->setColumns($options['columns']);
        }
        if (isset($options['row_actions'])) {
            $this->setRowActions($options['row_actions']);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     *
     * @return TableFieldsetCollection
     */
    public function setColumns($columns)
    {
        $this->columns->clear();
        foreach ($columns as $column) {
            $this->addColumn($column);
        }

        return $this;
    }

    public function addColumn(array $column, $priority = 0)
    {
        $column = new TableFieldset\Column($column);
        $this->columns->insert(
            $column->getElementName(),
            $column,
            $priority
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getRowActions()
    {
        return $this->rowActions;
    }

    /**
     * @param array $rowActions
     *
     * @return TableFieldsetCollection
     */
    public function setRowActions($rowActions)
    {
        $this->rowActions->clear();
        foreach ($rowActions as $action) {
            $this->addRowAction($action);
        }

        return $this;
    }


    public function addRowAction(array $action, $priority = 0)
    {
        $action = new TableFieldset\RowAction($action);
        $this->rowActions->insert(
            $action->getElementName(),
            $action,
            $priority
        );

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaption(): string
    {
        return (string)$this->caption;
    }

    /**
     * @param mixed $caption
     *
     * @return TableFieldsetCollection
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }


}