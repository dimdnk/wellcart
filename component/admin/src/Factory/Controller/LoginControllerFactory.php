<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Admin\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Controller\LoginController;

class LoginControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): LoginController
    {
        /* @var ControllerManager $sm */
        $serviceManager = $sm->getServiceLocator();

        /* @var RedirectCallback $redirectCallback */
        $redirectCallback = $serviceManager->get(
            'zfcuser_redirect_callback'
        );

        return new LoginController($redirectCallback);
    }
}
