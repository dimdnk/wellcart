<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Factory\Command\Handler;

use Interop\Container\ContainerInterface;
use WellCart\User\Command\Handler\PersistUserAccountHandler;

class PersistUserAccountHandlerFactory
{

    public function __invoke(
        ContainerInterface $container
    ): PersistUserAccountHandler {
        return new PersistUserAccountHandler(
            $container->get('zfcuser_user_service')
        );
    }
}
