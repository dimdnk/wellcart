<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Layout\EventListener;

use Zend\Console\Console;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class LoadLayoutListener
    extends \ConLayout\Listener\LoadLayoutListener
{

    /**
     *
     * @param EventManagerInterface $events
     * @param int                   $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        if (!Console::isConsole()) {
            $this->listeners[] = $events->attach(
                [MvcEvent::EVENT_DISPATCH, MvcEvent::EVENT_DISPATCH_ERROR],
                [$this, 'loadLayout'], $priority
            );
        }

    }
}
