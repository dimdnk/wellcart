<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Catalog\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Controller\Admin\FeaturesController;
use WellCart\Catalog\Spec\FeatureI18nRepository;

class FeaturesControllerFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null
    ): FeaturesController
    {
        $controller = new FeaturesController(
            $sm->getServiceLocator()
                ->get(FeatureI18nRepository::class)
        );
        return $controller;
    }
}
