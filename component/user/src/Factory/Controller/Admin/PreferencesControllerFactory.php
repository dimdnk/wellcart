<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller\Admin;

use WellCart\User\Controller\Admin\PreferencesController;
use WellCart\User\Form\AccountPreferences;
use WellCart\User\PageView\Admin\PreferencesForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PreferencesControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $services = $sm->getServiceLocator();
        $controller = new PreferencesController(
            $services->get('system_configuration_editor'),
            $services->get(
                AccountPreferences::class
            ),
            $services->get(
                PreferencesForm::class
            )
        );
        return $controller;
    }
}
