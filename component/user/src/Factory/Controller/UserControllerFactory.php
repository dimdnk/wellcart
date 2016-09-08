<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\User\Controller\UserController;

class UserControllerFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $serviceManager = $sm->getServiceLocator();
        $redirectCallback = $serviceManager->get(
            'zfcuser_redirect_callback'
        );
        return new UserController($redirectCallback);
    }
}
