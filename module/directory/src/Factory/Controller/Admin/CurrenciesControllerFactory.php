<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Directory\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Controller\Admin\CurrenciesController;
use WellCart\Directory\Spec\CurrencyRepository;

class CurrenciesControllerFactory
{
    public function __invoke(ContainerInterface $sm): CurrenciesController
    {
        $controller = new CurrenciesController(
            $sm->getServiceLocator()
                ->get(CurrencyRepository::class)
        );
        return $controller;
    }
}
