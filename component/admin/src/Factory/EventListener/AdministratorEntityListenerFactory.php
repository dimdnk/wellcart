<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Factory\EventListener;

use Interop\Container\ContainerInterface;
use WellCart\Admin\EventListener\AdministratorEntityListener;
use Zend\Authentication\AuthenticationService;

class AdministratorEntityListenerFactory
{
    public function __invoke(
        ContainerInterface $container
    ): AdministratorEntityListener {
        return new AdministratorEntityListener(
            $container->get(AuthenticationService::class)
        );
    }
}
