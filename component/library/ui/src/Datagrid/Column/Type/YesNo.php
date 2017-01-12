<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Datagrid\Column\Type;

use WellCart\Utility\Booleans;

class YesNo extends PhpString
{

    public function getTypeName()
    {
        return 'yesno';
    }

    /**
     * Convert a value into an array
     *
     * @param  mixed $value
     *
     * @return array
     */
    public function getUserValue($value)
    {
        if ($value === '') {
            return;
        }
        $validator = new Booleans();
        $isTrue = $validator->toBoolean($value);
        $label = ($isTrue) ? __('Yes') : __('No');
        $class = ($isTrue) ? 'success' : 'warning';

        return sprintf(
            '<span class="label label-%s">%s</span>', $class, $label
        );
    }
}
