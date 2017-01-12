<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\User\Controller\UserController;

class UserControllerFactory
{

    public function __invoke(ContainerInterface $sm
    ): UserController {
        $serviceManager = $sm->getServiceLocator();
        $redirectCallback = $serviceManager->get(
            'zfcuser_redirect_callback'
        );

        return new UserController($redirectCallback);
    }
}
