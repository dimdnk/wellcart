<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Backend\Controller\Backend\AccountsController;
use WellCart\Backend\Spec\AdministratorRepository;

class AccountsControllerFactory
{

    public function __invoke(ContainerInterface $sm
    ): AccountsController {
        $services = $sm->getServiceLocator();

        return new AccountsController(
            $services->get(
                AdministratorRepository::class
            )
        );
    }
}
