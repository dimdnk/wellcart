<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Router\Http;

use Zend\Router\Http\Literal as Route;

class Literal extends Route
{

    /**
     * Create a new literal route.
     *
     * @param  string $route
     * @param  array  $defaults
     */
    public function __construct($route, array $defaults = [])
    {
        if (empty($defaults['format'])) {
            $defaults['format'] = 'html';
        }

        parent:: __construct($route, $defaults);
    }
}