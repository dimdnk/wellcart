<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Directory\Factory\Controller\Admin;

use WellCart\Directory\Controller\Admin\CurrenciesController;
use WellCart\Directory\Spec\CurrencyRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CurrenciesControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new CurrenciesController(
            $sm->getServiceLocator()
                ->get(CurrencyRepository::class)
        );
        return $controller;
    }
}
