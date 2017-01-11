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
use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use SplPriorityQueue;

class CommandBusFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return MessageBusSupportingMiddleware
     */
    public function __invoke(ContainerInterface $container
    ): MessageBusSupportingMiddleware
    {
        $commandBus = new MessageBusSupportingMiddleware();

        $commandBusConfig = $container->get('command_bus.config');

        $middlewares = new SplPriorityQueue();
        foreach ($commandBusConfig['middlewares'] as $key => $value) {
            if (is_string($key) && is_array($value)) {
                $middleware = $key;
                $priority = isset($value['priority']) ? $value['priority'] : 0;
            } else {
                $middleware = $value;
                $priority = 0;
            }

            $middlewares->insert($middleware, $priority);
        }

        $orderedMiddlewares = iterator_to_array($middlewares, false);

        foreach ($orderedMiddlewares as $middleware) {
            $commandBus->appendMiddleware($container->get($middleware));
        }

        return $commandBus;
    }
}
