<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Directory\Factory\Controller\Admin;

use WellCart\Directory\Controller\Admin\CountriesController;
use WellCart\Directory\Spec\CountryRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CountriesControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new CountriesController(
            $sm->getServiceLocator()
                ->get(CountryRepository::class)
        );
        return $controller;
    }
}
