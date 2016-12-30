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
use SimpleBus\Message\Handler\Resolver\NameBasedMessageHandlerResolver;

class CommandHandlerResolverFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return NameBasedMessageHandlerResolver
     */
    public function __invoke(ContainerInterface $container
    ): NameBasedMessageHandlerResolver {
        $commandBusConfig = $container->get('command_bus.config');
        $commandNameResolverStrategy
            = $commandBusConfig['command_name_resolver_strategy'];

        $commandNameResolver = $container->get(
            $commandNameResolverStrategy
        );
        $commandHandlerMap = $container->get(
            'command_bus.command_handler_map'
        );

        return new NameBasedMessageHandlerResolver(
            $commandNameResolver,
            $commandHandlerMap
        );
    }
}
