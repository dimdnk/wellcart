<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\Factory;

use Interop\Container\ContainerInterface;

class CommandBusConfigFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return array
     */
    public function __invoke(ContainerInterface $container):array
    {
        $config = $container->get('Config');

        return $config['command_bus'];
    }
}
