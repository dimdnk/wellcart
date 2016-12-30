<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Form\Element\TableFieldset;


use Zend\Stdlib\AbstractOptions;

class Column extends AbstractOptions
{
    protected $elementName;
    protected $label;
    protected $width;
    protected $align;
    protected $rowClass;
    protected $cellClass;

    /**
     * @return mixed
     */
    public function getElementName()
    {
        return $this->elementName;
    }

    /**
     * @param mixed $elementName
     *
     * @return Column
     */
    public function setElementName($elementName)
    {
        $this->elementName = $elementName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     *
     * @return Column
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     *
     * @return Column
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlign()
    {
        return $this->align;
    }

    /**
     * @param mixed $align
     *
     * @return Column
     */
    public function setAlign($align)
    {
        $this->align = $align;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRowClass()
    {
        return $this->rowClass;
    }

    /**
     * @param mixed $rowClass
     *
     * @return Column
     */
    public function setRowClass($rowClass)
    {
        $this->rowClass = $rowClass;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCellClass()
    {
        return $this->cellClass;
    }

    /**
     * @param mixed $cellClass
     *
     * @return Column
     */
    public function setCellClass($cellClass)
    {
        $this->cellClass = $cellClass;
        return $this;
    }

}