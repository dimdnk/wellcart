<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Filter;

use WellCart\Utility\Str;
use Zend\Filter\AbstractFilter;

class Slugify extends AbstractFilter
{

    /**
     * Defined by Zend\Filter\FilterInterface
     *
     * Returns the url friendly string $value
     *
     * @param  string $value
     *
     * @return string
     */
    public function filter($value)
    {
        return Str::slug($value);
    }
}