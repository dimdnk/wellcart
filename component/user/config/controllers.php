<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User;

use Zend\Mvc\Controller\ControllerManager;

return [
    'factories' => [
        'zfcuser'                                    =>
            function (ControllerManager $sm) {
                $serviceManager = $sm->getServiceLocator();
                $redirectCallback = $serviceManager->get(
                    'zfcuser_redirect_callback'
                );
                $controller = new Controller\UserController($redirectCallback);
                return $controller;
            },
        'WellCart\User\Controller\ConfirmEmail'      =>
            function (ControllerManager $sm) {
                $controller = new Controller\ConfirmEmailController(
                    $sm->getServiceLocator()
                        ->get(
                            'WellCart\User\Service\Registration\AccountEmailHandler'
                        )
                );
                return $controller;
            },
        'WellCart\User\Controller\RecoverAccount'    =>
            function (ControllerManager $sm) {
                $controller = new Controller\RecoverAccountController(
                    $sm->getServiceLocator()
                        ->get('WellCart\User\Service\RecoverAccount')
                );
                return $controller;
            },
        'WellCart\User\Controller\Admin\Accounts'    =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\AccountsController(
                    $services->get(
                        'WellCart\User\Spec\UserRepository'
                    )
                );
                return $controller;
            },
        'WellCart\User\Controller\Admin\Acl\Roles'   =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\Acl\RolesController(
                    $services->get(
                        'WellCart\User\Spec\AclRoleRepository'
                    )
                );
                return $controller;
            },
        'WellCart\User\Controller\Admin\Preferences' =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\PreferencesController(
                    $services->get('system_configuration_editor'),
                    $services->get(
                        'WellCart\User\Form\AccountPreferences'
                    ),
                    $services->get(
                        'WellCart\User\PageView\Admin\PreferencesForm'
                    )
                );
                return $controller;
            },
    ],
];
