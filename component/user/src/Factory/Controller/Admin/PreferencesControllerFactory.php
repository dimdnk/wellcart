<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\User\Controller\Admin\PreferencesController;
use WellCart\User\Form\AccountPreferences;
use WellCart\User\PageView\Admin\PreferencesForm;

class PreferencesControllerFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null): PreferencesController
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
