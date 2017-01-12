<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Factory\EventListener\Entity;

use Interop\Container\ContainerInterface;
use WellCart\User\EventListener\Entity\UserEntityListener;
use Zend\Authentication\AuthenticationService;

class UserEntityListenerFactory
{

    public function __invoke(
        ContainerInterface $container
    ): UserEntityListener {
        return new UserEntityListener(
            $container->get(AuthenticationService::class)
        );
    }
}
