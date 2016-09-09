<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Service\Route;

use Zend\Text\Table\Table;

class Listing
{
    protected $http = [];
    protected $console = [];

    /**
     * Listing constructor.
     *
     * @param array $console
     * @param array $http
     */
    public function __construct(array $console, array $http)
    {
        $this->console = $console;
        $this->http = $http;
    }


    public function asTable(): Table
    {
        $table = new Table();
        return $table;
    }
}
