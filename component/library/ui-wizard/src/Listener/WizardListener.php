<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Listener;

use WellCart\Ui\Wizard\WizardEvent;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

class WizardListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(WizardEvent::EVENT_POST_PROCESS_STEP, [$this, 'persistStep'], 100);
    }

    /**
     * @param  EventInterface $e
     * @return string
     */
    public function persistStep(EventInterface $e)
    {
        $step   = $e->getTarget();
        $wizard = $step->getWizard();

        $sessionContainer = $wizard->getSessionContainer();
        if (empty($sessionContainer->steps)) {
            $sessionContainer->steps = [];
        }

        $stepName = $step->getName();
        $sessionContainer->steps[$stepName] = $step->toArray();
    }
}