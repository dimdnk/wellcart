<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\User\Factory\Controller\Backend\Acl;

use Interop\Container\ContainerInterface;
use WellCart\User\Controller\Backend\Acl\RolesController;
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
