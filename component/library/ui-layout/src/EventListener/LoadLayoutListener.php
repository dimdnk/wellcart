<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Layout\EventListener;

use Zend\Console\Console;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class LoadLayoutListener
    extends \WellCart\Ui\Layout\Listener\LoadLayoutListenerr
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
