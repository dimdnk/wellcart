<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Datagrid;

use ZfcDatagrid\Action\Mass as MassAction;

class GroupAction extends MassAction
{
    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->getTitle();
    }

    /**
     * @param mixed $label
     *
     * @return GroupAction
     */
    public function setLabel($label)
    {
        $this->setTitle($label);
        return $this;
    }
}