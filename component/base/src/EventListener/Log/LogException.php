<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Log;

use WellCart\Mvc\Application;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class LogException extends AbstractListenerAggregate
{

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH_ERROR,
            [$this, 'log'],
            -100
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER_ERROR,
            [$this, 'log'],
            -100
        );
    }

    /**
     * Log standard exception
     *
     * @param MvcEvent $e
     */
    public function log(MvcEvent $e)
    {
        $error = $e->getError();
        if ($error == Application::ERROR_EXCEPTION) {
            $exception = $e->getParam('exception');
            error_log((string)$exception);
        }
    }
}
