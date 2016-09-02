<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Admin\Factory\Controller;

use WellCart\Admin\Controller\SettingsController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SettingsControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        return new SettingsController(
            $sm->getServiceLocator()
                ->get('system_configuration_editor')
        );
    }
}
