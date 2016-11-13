<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Factory\EventListener\Login;

use Interop\Container\ContainerInterface;
use WellCart\User\EventListener\Login\HandleFailedLoginCount;
use WellCart\User\Spec\UserRepository;

class HandleFailedLoginCountFactory
{
    public function __invoke(
        ContainerInterface $container
    ): HandleFailedLoginCount {
        return new HandleFailedLoginCount(
            $container->get(UserRepository::class)
        );
    }
}
