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
use WellCart\Catalog\Controller\Backend\CategoriesController;
use WellCart\Catalog\Spec\CategoryI18nRepository;

class CategoriesControllerFactory
{

    public function __invoke(ContainerInterface $sm): CategoriesController
    {
        $controller = new CategoriesController(
            $sm->getServiceLocator()
                ->get(CategoryI18nRepository::class)
        );

        return $controller;
    }
}
