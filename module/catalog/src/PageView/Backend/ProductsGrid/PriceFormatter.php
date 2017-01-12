<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\PageView\Backend\ProductsGrid;

use ZfcDatagrid\Column\AbstractColumn;
use ZfcDatagrid\Column\Formatter\AbstractFormatter;

class PriceFormatter extends AbstractFormatter
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

        return format_price(
            $row['product']->getVariants()->current()->getPrice()
        );
    }
}
