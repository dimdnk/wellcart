<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\RestApi;

use Zend\Mvc\Controller\ControllerManager;

return [
    'factories' => [
        'WellCart\RestApi\Controller\Hello'                   =>
            function (ControllerManager $sm) {
                $controller = new Controller\HelloController();
                return $controller;
            },

        'WellCart\RestApi\Controller\Admin\OAuth2\PublicKeys' =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\OAuth2\PublicKeysController(
                    $services->get(
                        'WellCart\RestApi\Repository\OAuth2\PublicKeys'
                    )
                );
                return $controller;
            },

        'WellCart\RestApi\Controller\Admin\OAuth2\Clients'    =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\OAuth2\ClientsController(
                    $services->get(
                        'WellCart\RestApi\Repository\OAuth2\Clients'
                    )
                );
                return $controller;
            },

        'WellCart\RestApi\Controller\Admin\OAuth2\Scopes'     =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\OAuth2\ScopesController(
                    $services->get(
                        'WellCart\RestApi\Repository\OAuth2\Scopes'
                    )
                );
                return $controller;
            },
    ],
];
