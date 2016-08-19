<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog;

use Zend\Mvc\Controller\ControllerManager;

return [
    'factories' => [
        'WellCart\Catalog\Controller\Admin\Brands'           =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\BrandsController(
                    $services->get(
                        'WellCart\Catalog\Spec\BrandRepository'
                    )
                );
                return $controller;
            },
        'WellCart\Catalog\Controller\Admin\Products'         =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\ProductsController(
                    $services->get(
                        'WellCart\Catalog\Spec\ProductI18nRepository'
                    )
                );
                return $controller;
            },
        'WellCart\Catalog\Controller\Admin\Categories'       =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\CategoriesController(
                    $services->get(
                        'WellCart\Catalog\Spec\CategoryI18nRepository'
                    )
                );
                return $controller;
            },

        'WellCart\Catalog\Controller\Admin\Features'         =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\FeaturesController(
                    $services->get(
                        'WellCart\Catalog\Spec\FeatureI18nRepository'
                    )
                );
                return $controller;
            },

        'WellCart\Catalog\Controller\Admin\ProductTemplates' =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\ProductTemplatesController(
                    $services->get(
                        'WellCart\Catalog\Spec\ProductTemplateI18nRepository'
                    )
                );
                return $controller;
            },

        'WellCart\Catalog\Controller\Admin\Attributes'       =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\AttributesController(
                    $services->get(
                        'WellCart\Catalog\Spec\AttributeI18nRepository'
                    )
                );
                return $controller;
            },
    ],
];
