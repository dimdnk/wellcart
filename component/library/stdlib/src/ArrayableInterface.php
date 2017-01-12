<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Stdlib;

interface ArrayableInterface
{

    /**
     * Gets a native PHP array representation of the object.
     *
     * @return array
     */
    public function toArray();
}