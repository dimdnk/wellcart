<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Router\Http;

use Zend\Mvc\Router\Http\Scheme as Route;

class Scheme extends Route
{
    /**
     * Create a new scheme route.
     *
     * @param  string $scheme
     * @param  array  $defaults
     */
    public function __construct($scheme, array $defaults = array())
    {
        if (empty($defaults['format'])) {
            $defaults['format'] = 'html';
        }

        parent:: __construct($scheme, $defaults);
    }
}