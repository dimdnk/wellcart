<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Datagrid;

use ZfcDatagrid\Column\Select;

class Column extends Select
{

    /**
     * @var bool
     */
    protected $sortable = false;

    /**
     * @var bool
     */
    protected $filterable = false;

    /**
     * @var array
     */
    protected $filter = ['form_element' => 'text', 'expression' => 'eq'];

    /**
     * @return boolean
     */
    public function isSortable(): bool
    {
        return $this->sortable;
    }

    /**
     * @param boolean $sortable
     *
     * @return Column
     */
    public function setSortable(bool $sortable)
    {
        $this->sortable = $sortable;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isFilterable(): bool
    {
        return $this->filterable;
    }

    /**
     * @param boolean $filterable
     *
     * @return Column
     */
    public function setFilterable(bool $filterable)
    {
        $this->filterable = $filterable;

        return $this;
    }

    /**
     * @return array
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param string $formElement
     * @param string $expression
     *
     * @return Column
     */
    public function setFilter(string $formElement, string $expression)
    {
        $this->filter['form_element'] = $formElement;
        $this->filter['expression'] = $expression;

        return $this;
    }


}
