<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Factory;

use WellCart\Ui\Wizard\WizardFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WizardFactoryFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return WizardFactory
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('WellCart\Ui\Wizard\Config');

        $wizardFactory = new \WellCart\Ui\Wizard\WizardFactory($serviceLocator, $config);

        $stepFactory = $serviceLocator->get('WellCart\Ui\Wizard\Step\StepFactory');
        $wizardFactory->setStepFactory($stepFactory);

        return $wizardFactory;
    }
}
