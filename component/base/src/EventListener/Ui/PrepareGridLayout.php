<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Ui;

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
    }
}
