<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Router\Http;

use Zend\Router\Http\Scheme as Route;

class Scheme extends Route
{

    /**
     * Create a new scheme route.
     *
     * @param  string $scheme
     * @param  array  $defaults
     */
    public function __construct($scheme, array $defaults = [])
    {
        if (empty($defaults['format'])) {
            $defaults['format'] = 'html';
        }

        parent:: __construct($scheme, $defaults);
    }
}