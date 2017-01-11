<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\Factory;

use Interop\Container\ContainerInterface;
use SimpleBus\Message\Handler\DelegatesToMessageHandlerMiddleware;

class DelegatesToMessageHandlerMiddlewareFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return DelegatesToMessageHandlerMiddleware
     */
    public function __invoke(ContainerInterface $container
    ): DelegatesToMessageHandlerMiddleware
    {
        $commandHandlerResolver = $container->get(
            'command_bus.command_handler_resolver'
        );

        return new DelegatesToMessageHandlerMiddleware(
            $commandHandlerResolver
        );
    }
}
