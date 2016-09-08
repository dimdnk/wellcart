<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Catalog\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Controller\Admin\CategoriesController;
use WellCart\Catalog\Spec\CategoryI18nRepository;

class CategoriesControllerFactory
{
    public function __invoke(ContainerInterface $sm) :CategoriesController
    {
        $controller = new CategoriesController(
            $sm->getServiceLocator()
                ->get(CategoryI18nRepository::class)
        );
        return $controller;
    }
}
