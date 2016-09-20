<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Directory\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Controller\Admin\ZonesController;
use WellCart\Directory\Spec\ZoneRepository;

class ZonesControllerFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null
    ): ZonesController
    {
        $controller = new ZonesController(
            $sm->getServiceLocator()
                ->get(ZoneRepository::class)
        );
        return $controller;
    }
}
