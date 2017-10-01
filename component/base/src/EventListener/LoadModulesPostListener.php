<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);


namespace WellCart\Base\EventListener;

use Zend\EventManager\SharedEventManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\ServiceManager\ServiceManager;

/**
 * Class MergeConfigListener
 */
class LoadModulesPostListener
{
    /**
     * Attach event listeners from 'event_manager' config section.
     * Provides easy way to attach listeners via SharedEventManager..
     *
     * @param ModuleEvent $event
     */
    public function __invoke(ModuleEvent $event)
    {
        /**
         * @var ServiceManager $serviceManager
         * @var SharedEventManager $sem
         */
        $serviceManager = $event->getParam('ServiceManager');
        $sem = $event->getTarget()->getEventManager()->getSharedManager();
        $config = $serviceManager->get('Config');

        if (!isset($config['event_manager'])) {
            return;
        }

        if (isset($config['event_manager']['listeners'])) {
            foreach ($config['event_manager']['listeners'] as $listener) {
                // by default attach to any target
                $listener['id'] = isset($listener['id']) ? $listener['id'] : '*';
                // by default use standard priority
                $listener['priority'] = isset($listener['priority']) ? $listener['priority'] : 1;

                $proxy = new ProxyListener($listener['listener']);
                $proxy->setServiceLocator($serviceManager);

                $sem->attach(
                    $listener['id'],
                    $listener['event'],
                    $proxy,
                    $listener['priority']
                );
            }
        }

        if (isset($config['event_manager']['aggregates'])) {
            foreach ($config['event_manager']['aggregates'] as $aggregate) {
                $sem->attachAggregate(
                    $serviceManager->get($aggregate['aggregate']),
                    isset($aggregate['priority']) ? $aggregate['priority'] : 1
                );
            }
        }
    }
}
