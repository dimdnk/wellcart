<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\PageView\Backend\CategriesGrid;

use ZfcDatagrid\Column\AbstractColumn;
use ZfcDatagrid\Column\Formatter\AbstractFormatter;

class NameFormatter extends AbstractFormatter
{

    protected $validRenderers
        = [
            'HtmlDataGrid',
        ];

    /**
     *
     * @param AbstractColumn $columnUniqueId
     *
     * @return string
     */
    public function getFormattedValue(AbstractColumn $column)
    {
        $row = $this->getRowData();
        $category = $row['category'];
        $lvl = (int)$category['lvl'] - 1;
        if ($lvl < 0) {
            $lvl = 0;
        }
        return sprintf(
            '%s %s',
            str_repeat('-', $lvl),
            e($row[$column->getUniqueId()])
        );
    }
}
