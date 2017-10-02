<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Listener;

use WellCart\Ui\Wizard\Step\StepCollection;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

class StepCollectionListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(StepCollection::EVENT_ADD_STEP, [$this, 'restore'], 100);
    }

    /**
     * @param  EventInterface $e
     * @return string
     */
    public function restore(EventInterface $e)
    {
        $step   = $e->getTarget();
        $wizard = $step->getWizard();

        $sessionContainer = $wizard->getSessionContainer();
        if (empty($sessionContainer->steps)) {
            return;
        }

        $stepName = $step->getName();
        if (!isset($sessionContainer->steps[$stepName])) {
            return;
        }

        $step->setFromArray($sessionContainer->steps[$stepName]);
    }
}