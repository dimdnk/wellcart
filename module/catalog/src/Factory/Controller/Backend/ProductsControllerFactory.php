<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Catalog\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Controller\Backend\ProductsController;
use WellCart\Catalog\Spec\ProductI18nRepository;

class ProductsControllerFactory
{
    public function __invoke(ContainerInterface $sm): ProductsController
    {
        $controller = new ProductsController(
            $sm->getServiceLocator()
                ->get(ProductI18nRepository::class)
        );
        return $controller;
    }
}
