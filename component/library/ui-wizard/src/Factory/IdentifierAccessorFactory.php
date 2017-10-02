<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Factory;

use WellCart\Ui\Wizard\Wizard\IdentifierAccessor;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IdentifierAccessorFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return IdentifierAccessor
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $request = $serviceLocator->get('Request');

        return new IdentifierAccessor($request);
    }
}
