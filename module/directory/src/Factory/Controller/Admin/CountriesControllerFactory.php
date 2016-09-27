<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Directory\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Controller\Admin\CountriesController;
use WellCart\Directory\Spec\CountryRepository;

class CountriesControllerFactory
{
    public function __invoke(ContainerInterface $sm): CountriesController
    {
        $controller = new CountriesController(
            $sm->getServiceLocator()
                ->get(CountryRepository::class)
        );
        return $controller;
    }
}
