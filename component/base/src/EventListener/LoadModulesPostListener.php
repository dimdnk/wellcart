<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);


namespace WellCart\Base\EventListener;

use WellCart\Utility\Config;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\SharedEventManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\ServiceManager\ServiceManager;

/**
 * Class MergeConfigListener
 */
class LoadModulesPostListener extends AbstractListenerAggregate implements
  ListenerAggregateInterface
{
  /**
   * Attach listener to ModuleEvent::EVENT_LOAD_MODULES_POST
   *
   * @param EventManagerInterface $events
   * @param int                   $priority
   */
  public function attach(EventManagerInterface $events, $priority = 1)
  {
    $this->listeners[] = $events->attach(
      ModuleEvent::EVENT_LOAD_MODULES_POST, [$this, '__invoke'],
      999
    );
  }

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
        $config = Config::get('event_manager');
        if (empty($config)) {
            return;
        }

        if (isset($config['listeners'])) {
            foreach ($config['listeners'] as $listener) {
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

        if (isset($config['aggregates'])) {
            foreach ($config['aggregates'] as $aggregate) {
              $serviceManager->get($aggregate['aggregate'])->attach($sem,  isset($aggregate['priority']) ? $aggregate['priority'] : 1);

            }
        }
    }
}
