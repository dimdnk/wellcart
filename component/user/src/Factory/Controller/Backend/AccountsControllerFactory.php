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
use WellCart\User\Controller\Backend\AccountsController;
use WellCart\User\Spec\UserRepository;

class AccountsControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): AccountsController
    {
        $services = $sm->getServiceLocator();
        $controller = new AccountsController(
            $services->get(
                UserRepository::class
            )
        );
        return $controller;
    }
}
