<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Money\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\InitializerInterface;

use WellCart\Money\Service\CurrencyListAwareInterface;

class CurrencyListInitializer implements InitializerInterface
{

    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if (is_object($instance) && $instance instanceof CurrencyListAwareInterface) {
            $instance->setCurrencyList($this->getCurrencyList($serviceLocator));
        }
    }

    public function getCurrencyList(ServiceLocatorInterface $serviceLocator)
    {
        if (is_subclass_of($serviceLocator, 'Zend\ServiceManager\ServiceManager')) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }

        return $serviceLocator->get('WellCart\Money\Service\CurrencyList');
    }

}
