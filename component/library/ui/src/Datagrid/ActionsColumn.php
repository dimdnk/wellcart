<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Datagrid;

use ZfcDatagrid\Column\Action as AbstractAction;

class ActionsColumn extends AbstractAction
{

    /**
     * @return boolean
     */
    public function isSortable(): bool
    {
        return false;
    }

    /**
     * @return boolean
     */
    public function isFilterable(): bool
    {
        return false;
    }
}
