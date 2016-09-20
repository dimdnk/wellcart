<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Factory\Command\Handler;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Command\Handler\PersistAdminAccountHandler;
use WellCart\User\Spec\AclRoleRepository;

class PersistAdminAccountHandlerFactory
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): PersistAdminAccountHandler
    {
        return new PersistAdminAccountHandler(
            $container->get('zfcuser_user_service'),
            $container->get(AclRoleRepository::class)->findDefaultRole()
        );
    }
}
