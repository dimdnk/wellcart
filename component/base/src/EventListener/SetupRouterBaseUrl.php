<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener;

use WellCart\Utility\Config;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\TreeRouteStack;

class SetupRouterBaseUrl extends AbstractListenerAggregate
{

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_ROUTE,
            [$this, 'onRoute'],
            -100
        );
    }

    /**
     * @param MvcEvent $event
     *
     */
    public function onRoute(MvcEvent $event)
    {
        $router = $event->getRouter();
        if ($router instanceof TreeRouteStack) {
            $router->setBaseUrl(Config::get('router.base_path', '/'));
        }
    }
}
