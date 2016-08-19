<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\PageView\Admin\ColumnType;

use WellCart\Ui\Datagrid\Column\Type\PhpString;

class Country extends PhpString
{

    /**
     * Convert the value from the source to the value, which the user will see
     *
     * @param string $country
     *
     * @return string
     */
    public function getUserValue($country)
    {
        if (!empty($country['name'])) {
            return $country['name'];
        }
        return null;
    }
}
