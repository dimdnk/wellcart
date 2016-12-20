<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Directory\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Controller\Backend\CurrenciesController;
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
