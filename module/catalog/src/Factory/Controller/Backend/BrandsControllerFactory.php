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
use WellCart\Catalog\Controller\Backend\BrandsController;
use WellCart\Catalog\Spec\BrandRepository;

class BrandsControllerFactory
{

    public function __invoke(ContainerInterface $sm): BrandsController
    {
        $controller = new BrandsController(
            $sm->getServiceLocator()
                ->get(BrandRepository::class)
        );

        return $controller;
    }
}
