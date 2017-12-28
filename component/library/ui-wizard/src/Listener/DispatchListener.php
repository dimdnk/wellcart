<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Listener;

use WellCart\Ui\Wizard\WizardFactory;
use WellCart\Ui\Wizard\WizardResolver;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;

class DispatchListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @var WizardResolver
     */
    protected $resolver;

    /**
     * @var WizardFactory
     */
    protected $factory;

    /**
     * @param WizardResolver $resolver
     * @param WizardFactory $factory
     */
    public function __construct(WizardResolver $resolver, WizardFactory $factory)
    {
        $this->resolver = $resolver;
        $this->factory  = $factory;
    }

  /**
   * @param EventManagerInterface $events
   * @param int                   $priority
   */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'process'], 10);
    }

    /**
     * @param  MvcEvent $e
     */
    public function process(MvcEvent $e)
    {
        $wizard = $this->resolver->resolve();
        if (!$wizard) {
            return;
        }

        $instance = $this->factory->create($wizard);
        $instance->process();
    }
}
