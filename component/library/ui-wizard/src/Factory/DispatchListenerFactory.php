<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Factory;

use WellCart\Ui\Wizard\Listener\DispatchListener;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DispatchListenerFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return DispatchListener
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $resolver = $serviceLocator->get('WellCart\Ui\Wizard\WizardResolver');
        $factory  = $serviceLocator->get('WellCart\Ui\Wizard\WizardFactory');

        return new DispatchListener($resolver, $factory);
    }
}
