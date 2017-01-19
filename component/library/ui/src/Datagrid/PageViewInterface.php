<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Ui\Datagrid;

use WellCart\ORM\QueryBuilder;

interface PageViewInterface extends
    \WellCart\Ui\Container\PageViewInterface
{
    public function getRouteName();
    public function configureGrid();
    public function getUiConfigKey();
    public function setUiConfigKey(string $uiConfigKey);
    public function addToolbarAction(ToolbarAction $button);
    public function getToolbarAction($name);
    public function removeToolbarAction($name);
    public function getColumn($name);
    public function removeColumn($name);
    public function addGroupAction(GroupAction $button);
    public function getGroupAction($name);
    public function removeGroupAction($name);
    public function prepare($template = null, $values = null);
    public function addColumn($column);
    public function configureQueryBuilder(QueryBuilder $qb);
    public function getDefaultOrder();
    public function setDefaultOrder($sortBy, $sortOrder = 'asc');
}