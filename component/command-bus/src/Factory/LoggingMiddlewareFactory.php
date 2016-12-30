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
use Psr\Log\LogLevel;
use SimpleBus\Message\Logging\LoggingMiddleware;

class LoggingMiddlewareFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return LoggingMiddleware
     */
    public function __invoke(ContainerInterface $container): LoggingMiddleware
    {
        $logger = $container->get('logger');

        return new LoggingMiddleware($logger, LogLevel::INFO);
    }
}
