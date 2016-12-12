<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Controller\RecoverAccountController;
use WellCart\Admin\Service\RecoverAccount;

class RecoverAccountControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): RecoverAccountController
    {
        return new RecoverAccountController(
            $sm->getServiceLocator()
                ->get(RecoverAccount::class)
        );
    }
}
