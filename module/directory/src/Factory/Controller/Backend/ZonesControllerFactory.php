<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Directory\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Controller\Backend\ZonesController;
use WellCart\Directory\Spec\ZoneRepository;

class ZonesControllerFactory
{
    public function __invoke(ContainerInterface $sm): ZonesController
    {
        $controller = new ZonesController(
            $sm->getServiceLocator()
                ->get(ZoneRepository::class)
        );
        return $controller;
    }
}
