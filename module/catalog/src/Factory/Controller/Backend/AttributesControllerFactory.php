<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Catalog\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Controller\Backend\AttributesController;
use WellCart\Catalog\Spec\AttributeI18nRepository;

class AttributesControllerFactory
{
    public function __invoke(ContainerInterface $sm): AttributesController
    {
        $controller = new AttributesController(
            $sm->getServiceLocator()
                ->get(AttributeI18nRepository::class)
        );
        return $controller;
    }
}
