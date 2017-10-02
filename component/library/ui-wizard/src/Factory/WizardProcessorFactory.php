<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Factory;

use WellCart\Ui\Wizard\WizardProcessor;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WizardProcessorFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return WizardProcessor
    */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $request  = $serviceLocator->get('Request');
        $response = $serviceLocator->get('Response');

        return new \WellCart\Ui\Wizard\WizardProcessor($request, $response);
    }
}
