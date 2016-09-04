<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Directory\Factory\Controller\Admin;

use WellCart\Directory\Controller\Admin\ZonesController;
use WellCart\Directory\Spec\ZoneRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZonesControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new ZonesController(
            $sm->getServiceLocator()
                ->get(ZoneRepository::class)
        );
        return $controller;
    }
}
