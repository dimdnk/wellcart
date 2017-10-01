<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener;

use Zend\EventManager\EventInterface;
use Zend\ServiceManager;

/**
 * Class ProxyListener
 */
class ProxyListener implements ServiceManager\ServiceLocatorAwareInterface
{
    use ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @var string
     */
    protected $listener;

    /**
     * @param string $listener
     */
    public function __construct($listener)
    {
        $this->listener = $listener;
    }

    /**
     * @param EventInterface $event
     * @return mixed
     */
    public function __invoke(EventInterface $event)
    {
        $serviceLocator = $this->getServiceLocator();
        $listener = null;

        if ($serviceLocator->has($this->listener)) {
            $listener = $serviceLocator->get($this->listener);
        } elseif (class_exists($this->listener)) {
            $listener = new $this->listener;
        }

        return $listener ? $listener->__invoke($event) : null;
    }
}
