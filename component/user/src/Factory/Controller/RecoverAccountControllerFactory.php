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
use WellCart\Backend\Service\RecoverAccount;
use WellCart\User\Controller\RecoverAccountController;

class RecoverAccountControllerFactory
{

    public function __invoke(ContainerInterface $sm
    ): RecoverAccountController {
        $controller = new RecoverAccountController(
            $sm->getServiceLocator()
                ->get(RecoverAccount::class)
        );

        return $controller;
    }
}
