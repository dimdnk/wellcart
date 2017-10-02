<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Factory;

use WellCart\Ui\Wizard\Step\StepFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StepFactoryFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return StepFactory
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $stepPluginManager = $serviceLocator->get('WellCart\Ui\Wizard\Step\StepPluginManager');
        $formPluginManager = $serviceLocator->get('FormElementManager');

        return new StepFactory($stepPluginManager, $formPluginManager);
    }
}
