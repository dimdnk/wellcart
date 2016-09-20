<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Catalog\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Controller\Admin\BrandsController;
use WellCart\Catalog\Spec\BrandRepository;

class BrandsControllerFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null): BrandsController
    {
        $controller = new BrandsController(
            $sm->getServiceLocator()
                ->get(BrandRepository::class)
        );
        return $controller;
    }
}
