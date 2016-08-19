<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\PageView\Admin\NotificationsGrid;

use ZfcDatagrid\Column\AbstractColumn;
use ZfcDatagrid\Column\Formatter\AbstractFormatter;

class TitleFormatter extends AbstractFormatter
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
        if (!$row['is_read']) {
            $icon = $row['icon'] . ' text-danger';
        } else {
            $icon = $row['icon'];
        }

        return sprintf(
            '<i class="%s fa-md" aria-hidden="true"></i> &nbsp; %s',
            $icon,
            $row['title']
        );
    }
}
