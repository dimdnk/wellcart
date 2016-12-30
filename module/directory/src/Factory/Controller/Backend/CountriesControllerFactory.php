<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Directory\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Controller\Backend\CountriesController;
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
