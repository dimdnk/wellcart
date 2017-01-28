<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Router\Http;

use Zend\Mvc\Router\Http\Hostname as Route;

class Hostname extends Route
{

    /**
     * Create a new hostname route.
     *
     * @param  string $route
     * @param  array  $constraints
     * @param  array  $defaults
     */
    public function __construct($route, array $constraints = [],
        array $defaults = []
    ) {
        if (empty($defaults['format'])) {
            $defaults['format'] = 'html';
        }

        parent::__construct($route, $constraints, $defaults);
    }
}