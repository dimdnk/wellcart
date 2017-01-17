<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Base\EventListener\Ui;

use SplPriorityQueue;
use WellCart\Ui\Datagrid\Datagrid;
use WellCart\Ui\Datagrid\PageViewInterface;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use Zend\EventManager\EventInterface;

class PrepareGridLayout
{

    /**
     * @param EventInterface $event
     */
    public function __invoke(EventInterface $event)
    {
        $page = $event->getTarget();
        if (!$page instanceof PageViewInterface) {
            return;
        }
        /**
         * @var $grid Datagrid
         */
        $grid = $event->getParam('grid');
        $name = $page->getUiConfigKey();
        $config = Config::get('ui.component.grid.' . $name, []);
        if (empty($config)) {
            return;
        }

        $middlewares = Arr::get($config, 'middlewares', []);
        unset($config['middlewares']);

        $this->groupActionsFactory(
            Arr::get($config, 'group_actions', []), $grid
        );
        $this->toolbarFactory(Arr::get($config, 'toolbar', []), $grid);
        $this->columnsFactory(Arr::get($config, 'columns', []), $grid);
        $this->actionsFactory(Arr::get($config, 'actions', []), $grid);
        if (!empty($middlewares)) {
            $this->handleMiddlewares($middlewares, $page, $grid);
        }
    }

    public function groupActionsFactory(array $actions, Datagrid $grid)
    {
        foreach ($actions as $index => $spec) {

        }
    }

    public function toolbarFactory(array $buttons, Datagrid $grid)
    {
        foreach ($buttons as $index => $spec) {

        }
    }

    public function columnsFactory(array $columns, Datagrid $grid)
    {
        foreach ($columns as $index => $spec) {

        }
    }

    public function actionsFactory(array $actions, Datagrid $grid)
    {
        foreach ($actions as $index => $spec) {

        }
    }

    public function handleMiddlewares(
        array $config,
        PageViewInterface $page,
        Datagrid $grid
    ) {
        $middlewares = new SplPriorityQueue();
        foreach ($config as $key => $value) {
            if (is_string($key) && is_array($value)) {
                $middleware = $key;
                $priority = isset($value['priority']) ? $value['priority'] : 0;
            } else {
                $middleware = $value;
                $priority = 0;
            }

            $middlewares->insert($middleware, $priority);
        }
        $orderedMiddlewares = iterator_to_array($middlewares, false);
        foreach ($orderedMiddlewares as $callable) {
            $callable($page, $grid);
        }
    }
}
