<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Admin;

use Zend\Mvc\Controller\ControllerManager;

return [
    'factories' => [
        'WellCart\Admin\Controller\Login'               =>
            function (ControllerManager $sm) {
                /* @var ControllerManager $sm */
                $serviceManager = $sm->getServiceLocator();

                /* @var RedirectCallback $redirectCallback */
                $redirectCallback = $serviceManager->get(
                    'zfcuser_redirect_callback'
                );

                $controller = new Controller\LoginController(
                    $redirectCallback
                );
                return $controller;
            },
        'WellCart\Admin\Controller\Logout'              =>
            function (ControllerManager $sm) {
                $controller = new Controller\LogoutController();
                return $controller;
            },
        'WellCart\Admin\Controller\RecoverAccount'      =>
            function (ControllerManager $sm) {
                $controller = new Controller\RecoverAccountController(
                    $sm->getServiceLocator()
                        ->get('WellCart\Admin\Service\RecoverAccount')
                );
                return $controller;
            },
        'WellCart\Admin\Controller\Dashboard'           =>
            function (ControllerManager $sm) {
                $controller = new Controller\DashboardController();
                return $controller;
            },
        'WellCart\Admin\Controller\Settings'            =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\SettingsController(
                    $services->get('system_configuration_editor')
                );
                return $controller;
            },

        'WellCart\Admin\Controller\Admin\Accounts'      =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\AccountsController(
                    $services->get(
                        'WellCart\Admin\Spec\AdministratorRepository'
                    )
                );
                return $controller;
            },
        'WellCart\Admin\Controller\Admin\Notifications' =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\NotificationsController(
                    $services->get(
                        'WellCart\Admin\Spec\NotificationRepository'
                    )
                );
                return $controller;
            },
    ],
];
