<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Backend\Controller\LoginController;

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
