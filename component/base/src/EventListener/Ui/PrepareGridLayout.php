<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Ui;

use SplPriorityQueue;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;
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
         * @var $grid Datagrid\Datagrid
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
            Arr::get($config, 'group_actions', []), $page, $grid
        );
        $this->toolbarFactory(Arr::get($config, 'toolbar', []), $page, $grid);
        $this->columnsFactory(Arr::get($config, 'columns', []), $page, $grid);
        $this->actionsFactory(Arr::get($config, 'actions', []), $page, $grid);
        if (!empty($middlewares)) {
            $this->handleMiddlewares($middlewares, $page, $grid);
        }
    }

    /**
     * @param array             $actions
     * @param PageViewInterface $page
     * @param Datagrid\Datagrid $grid
     */
    public function groupActionsFactory(
        array $actions,
        PageViewInterface $page,
        Datagrid\Datagrid $grid
    ) {
        foreach ($actions as $index => $spec) {

            $action = new Datagrid\GroupAction();
            $action->setLabel(__(Arr::get($spec, 'label', '')));
            $action->setLink(
                url_to_route(
                    Arr::get($spec, 'route.name') ?: $page->getRouteName(),
                    [
                        'action' => Arr::get(
                            $spec,
                            'route.action',
                            'group-action-handler'
                        ),
                        'id'     => Arr::get($spec, 'action'),
                    ]
                )
            );
            $page->addGroupAction($action);

        }
    }

    /**
     * @param array             $buttons
     * @param PageViewInterface $page
     * @param Datagrid\Datagrid $grid
     */
    public function toolbarFactory(
        array $buttons,
        PageViewInterface $page,
        Datagrid\Datagrid $grid
    ) {
        foreach ($buttons as $index => $spec) {

            $action = new Datagrid\ToolbarAction();
            $action->setLabel(__(Arr::get($spec, 'label', '')))
                ->setName(Arr::get($spec, 'name', $index))
                ->setClass(
                    Arr::get($spec, 'class', 'btn btn-toolbar-action')
                )
                ->setIcon(Arr::get($spec, 'icon'))
                ->setLink(
                    url_to_route(
                        Arr::get($spec, 'route.name') ?: $page->getRouteName(),
                        [
                            'action' => Arr::get($spec, 'route.action'),
                        ]
                    )
                );
            $page->addToolbarAction($action);
        }
    }

    /**
     * @param array             $columns
     * @param PageViewInterface $page
     * @param Datagrid\Datagrid $grid
     */
    public function columnsFactory(
        array $columns,
        PageViewInterface $page,
        Datagrid\Datagrid $grid
    ) {
        foreach ($columns as $index => $spec) {
            $col = new Datagrid\Column($index);
            $col->setLabel(__(Arr::get($spec, 'label', '')));
            $col->setWidth(Arr::get($spec, 'width'));
            $col->setSortable(Arr::get($spec, 'sortable', true));
            $col->setFilterable(Arr::get($spec, 'filterable', true));
            $col->setFilter(
                Arr::get($spec, 'filter.element', 'text'),
                Arr::get($spec, 'filter.expression', 'like')
            );
            $page->addColumn($col);
        }
    }

    /**
     * @param array             $actions
     * @param PageViewInterface $page
     * @param Datagrid\Datagrid $grid
     */
    public function actionsFactory(
        array $actions,
        PageViewInterface $page,
        Datagrid\Datagrid $grid
    ) {
        $control = $grid->getActionsColumn();
        if (!$control) {
            return;
        }
        foreach ($actions as $index => $spec) {
            $action = new Datagrid\ActionButton();
            $action->setLabel(Arr::get($spec, 'label'));
            $action->setAttribute('class', Arr::get($spec, 'class'));
            $action->setAttribute('title', Arr::get($spec, 'title'));
            $action->setAttribute('data-toggle', 'tooltip');
            $action->setAttribute(
                'href',
                url_to_route(
                    Arr::get($spec, 'route.name') ?: $page->getRouteName(),
                    [
                        'action' => Arr::get($spec, 'route.action'),
                        'id'     => $action->getRowIdPlaceholder(),
                    ]
                )
            );
            $control->addAction($action);
        }
        $page->addColumn($control);
    }

    /**
     * @param array             $config
     * @param PageViewInterface $page
     * @param Datagrid\Datagrid $grid
     */
    public function handleMiddlewares(
        array $config,
        PageViewInterface $page,
        Datagrid\Datagrid $grid
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
            $callable = new $callable;
            $callable($page, $grid);
        }
    }
}
