<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Setup\Data;

use Doctrine\Common\Persistence\ObjectManager;
use WellCart\Setup\DataFixture\AbstractFixture;
use WellCart\Setup\DataFixture\PermissionsProviderInterface;
use WellCart\User\Entity\Acl\Role;

/**
 * @codeCoverageIgnore
 */
class Install
    extends AbstractFixture
    implements PermissionsProviderInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $superadmin = new Role;
        $superadmin->setName('superadmin')
            ->setDescription('Administrative user, has access to everything.')
            ->setIsSystem(true);

        $admin = new Role;
        $admin->setName('admin')
            ->setDescription('Grunt administrative access.')
            ->setIsSystem(true);


        $guest = new Role;
        $guest->setName('guest')
            ->setDescription('Guest user.')
            ->setIsDefault(false)
            ->setIsSystem(true);

        $user = new Role;
        $user->setName('user')
            ->setDescription('Generic User Role.')
            ->setIsDefault(true)
            ->setIsSystem(true);

        $manager->persist($superadmin);
        $manager->persist($admin);
        $manager->persist($guest);
        $manager->persist($user);
        $manager->flush();
    }

    public function getPermissionsDefinition(): array
    {
        return [
            ['name' => 'user/accounts/group-action-handler',],
            ['name' => 'user/accounts/list',],
            ['name' => 'user/accounts/view',],
            ['name' => 'user/accounts/create',],
            ['name' => 'user/accounts/update',],
            ['name' => 'user/accounts/delete',],
            ['name' => 'user/preferences/view',],
            ['name' => 'user/preferences/update',],
            ['name' => 'user/roles/group-action-handler',],
            ['name' => 'user/roles/list',],
            ['name' => 'user/roles/view',],
            ['name' => 'user/roles/create',],
            ['name' => 'user/roles/update',],
            ['name' => 'user/roles/delete',],
            ['name' => 'user/roles/preferences/view',],
            ['name' => 'user/roles/preferences/update',],
        ];
    }
}
