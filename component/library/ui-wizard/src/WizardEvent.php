<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard;

use WellCart\Ui\Wizard\WizardInterface;
use Zend\EventManager\Event;

class WizardEvent extends Event
{
    const EVENT_INIT = 'wizard-init';
    const EVENT_COMPLETE = 'wizard-complete';
    const EVENT_PRE_PROCESS_STEP = 'step-pre-process';
    const EVENT_POST_PROCESS_STEP = 'step-post-process';

    /**
     * @var WizardInterface
     */
    protected $wizard;

    /**
     * @param  WizardInterface $wizard
     * @return self
     */
    public function setWizard(WizardInterface $wizard)
    {
        $this->setParam('wizard', $wizard);
        $this->wizard = $wizard;
        return $this;
    }

    /**
     * @return WizardInterface
     */
    public function getWizard()
    {
        return $this->wizard;
    }
}
