<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Factory\Service;

use Interop\Container\ContainerInterface;
use WellCart\User\Service\User;

class UserFactory
{
    public function __invoke(ContainerInterface $container): User
    {
        return new User(
            $container->get('zfcuser_user_mapper'),
            $container->get('zfcuser_auth_service'),
            $container->get('zfcuser_register_form'),
            $container->get('zfcuser_change_password_form'),
            $container->get('zfcuser_register_form_hydrator'),
            $container->get('zfcuser_module_options')
        );
    }
}
