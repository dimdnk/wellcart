<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Directory\Factory\Controller\Admin;

use WellCart\Directory\Controller\Admin\GeoZonesController;
use WellCart\Directory\Spec\GeoZoneRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GeoZonesControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new GeoZonesController(
            $sm->getServiceLocator()
                ->get(GeoZoneRepository::class)
        );
        return $controller;
    }
}
