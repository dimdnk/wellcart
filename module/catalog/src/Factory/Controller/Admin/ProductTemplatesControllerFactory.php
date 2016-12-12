<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Catalog\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Controller\Admin\ProductTemplatesController;
use WellCart\Catalog\Spec\ProductTemplateI18nRepository;

class ProductTemplatesControllerFactory
{
    public function __invoke(ContainerInterface $sm): ProductTemplatesController
    {
        $controller = new ProductTemplatesController(
            $sm->getServiceLocator()
                ->get(ProductTemplateI18nRepository::class)
        );
        return $controller;
    }
}
