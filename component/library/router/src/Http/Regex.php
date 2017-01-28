<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Router\Http;

use Zend\Mvc\Router\Http\Regex as Route;

class Regex extends Route
{

    /**
     * Create a new regex route.
     *
     * @param  string $regex
     * @param  string $spec
     * @param  array  $defaults
     */
    public function __construct($regex, $spec, array $defaults = [])
    {
        if (empty($defaults['format'])) {
            $defaults['format'] = 'html';
        }
        parent::__construct($regex, $spec, $defaults);
    }
}