<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Catalog\Factory\Controller\Admin;

use WellCart\Catalog\Controller\Admin\BrandsController;
use WellCart\Catalog\Spec\BrandRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BrandsControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new BrandsController(
            $sm->getServiceLocator()
                ->get(BrandRepository::class)
        );
        return $controller;
    }
}
