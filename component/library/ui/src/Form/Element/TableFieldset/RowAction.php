<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Form\Element\TableFieldset;


use Zend\Stdlib\AbstractOptions;

class RowAction extends AbstractOptions
{
    protected $elementName;

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
     * @return RowAction
     */
    public function setElementName($elementName)
    {
        $this->elementName = $elementName;
        return $this;
    }

}