<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Directory\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Controller\Admin\GeoZonesController;
use WellCart\Directory\Spec\GeoZoneRepository;

class GeoZonesControllerFactory
{
    public function __invoke(ContainerInterface $sm): GeoZonesController
    {
        $controller = new GeoZonesController(
            $sm->getServiceLocator()
                ->get(GeoZoneRepository::class)
        );
        return $controller;
    }
}
