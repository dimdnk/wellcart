<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\User\Factory\Controller\Admin\Acl;

use Interop\Container\ContainerInterface;
use WellCart\User\Controller\Admin\Acl\RolesController;
use WellCart\User\Spec\AclRoleRepository;

class RolesControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): RolesController {
        $services = $sm->getServiceLocator();
        $controller = new RolesController(
            $services->get(
                AclRoleRepository::class
            )
        );
        return $controller;
    }
}
