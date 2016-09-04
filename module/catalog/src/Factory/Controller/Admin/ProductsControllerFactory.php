<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Catalog\Factory\Controller\Admin;

use WellCart\Catalog\Controller\Admin\ProductsController;
use WellCart\Catalog\Spec\ProductI18nRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductsControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new ProductsController(
            $sm->getServiceLocator()
                ->get(ProductI18nRepository::class)
        );
        return $controller;
    }
}
