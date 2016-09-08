<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\User\Controller\Admin\AccountsController;
use WellCart\User\Spec\UserRepository;

class AccountsControllerFactory
{
    public function __invoke(ContainerInterface $sm)
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
