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
use SimpleBus\Message\CallableResolver\CallableMap;

class CommandHandlerMapFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return CallableMap
     */
    public function __invoke(ContainerInterface $container): CallableMap
    {
        $commandBusConfig = $container->get('command_bus.config');
        $callableResolver = $container->get(
            'command_bus.callable_resolver'
        );

        return new CallableMap(
            $commandBusConfig['command_map'],
            $callableResolver
        );
    }
}
