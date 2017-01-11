<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\User\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\User\Controller\Backend\PreferencesController;
use WellCart\User\Form\AccountPreferences;
use WellCart\User\PageView\Backend\PreferencesForm;

class PreferencesControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): PreferencesController
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
