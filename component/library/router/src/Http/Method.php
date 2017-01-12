<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Router\Http;

use Zend\Mvc\Router\Http\Method as Route;

class Method extends Route
{

    /**
     * Create a new method route.
     *
     * @param  string $verb
     * @param  array  $defaults
     */
    public function __construct($verb, array $defaults = [])
    {
        if (empty($defaults['format'])) {
            $defaults['format'] = 'html';
        }

        parent:: __construct($verb, $defaults);
    }
}