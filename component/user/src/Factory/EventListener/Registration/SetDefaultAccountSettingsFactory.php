<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Factory\EventListener\Registration;

use Interop\Container\ContainerInterface;
use WellCart\Base\Spec\LocaleLanguageRepository;
use WellCart\User\EventListener\Registration\SetDefaultAccountSettings;
use WellCart\User\Spec\AclRoleRepository;

class SetDefaultAccountSettingsFactory
{

    public function __invoke(
        ContainerInterface $container
    ): SetDefaultAccountSettings {
        return new SetDefaultAccountSettings(
            $container->get(AclRoleRepository::class),
            $container->get(LocaleLanguageRepository::class)
                ->findDefaultLanguage()
        );
    }
}
