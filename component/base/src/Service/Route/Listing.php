<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Service\Route;

use WellCart\Utility\Arr;
use Zend\Text\Table\Row;
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
        $_rows = $this->collectRows();
        $table = new Table(
            ['columnWidths' => [30, 30, 50, 20], 'decorator' => 'ascii']
        );
        foreach ($_rows as $type => $rows) {
            $title = new Row;
            $title->createColumn(
                strtoupper($type), ['colSpan' => 4, 'align' => 'center']
            );
            $table->appendRow($title);
            $subTitle = new Row;
            $subTitle->createColumn('Name', ['align' => 'center']);
            $subTitle->createColumn('Path', ['align' => 'center']);
            $subTitle->createColumn('Controller', ['align' => 'center']);
            $subTitle->createColumn('Action', ['align' => 'center']);
            $table->appendRow($subTitle);

            foreach ($rows as $data) {
                $row = new Row;
                $row->createColumn($data['name']);
                $row->createColumn($data['path']);
                $row->createColumn($data['controller']);
                $row->createColumn($data['action']);
                $table->appendRow($row);

            }
        }
        return $table;
    }

    protected function collectRows(): array
    {
        $http = $this->format($this->http);
        $console = $this->format($this->console);
        return [
            'Http'    => $http,
            'Console' => $console,
        ];
    }

    private function format(array $params, $prefix = '')
    {
        if (!empty($prefix)) {
            $prefix .= '@';
        }
        $result = [];
        foreach ($params as $name => $route) {
            $path = Arr::get($route, 'options.route');


            $result[] = [
                'name'       => $prefix . $name,
                'path'       => $prefix . $path,
                'controller' => Arr::get($route, 'options.defaults.controller'),
                'action'     => Arr::get($route, 'options.defaults.action'),
            ];
            if (!empty($route['child_routes'])) {
                $result = array_merge(
                    $result, $this->format($route['child_routes'], $name)
                );
            }
        }
        return $result;
    }
}
