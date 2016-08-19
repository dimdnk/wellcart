<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Setup\Data;

use Doctrine\Common\Persistence\ObjectManager;
use WellCart\Setup\DataFixture\AbstractFixture;
use WellCart\User\Entity\Acl\Permission;
use WellCart\User\Entity\Acl\Role;
use WellCart\Utility\Arr;

/**
 * @codeCoverageIgnore
 */
class Install extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadPermissions($manager);
        $admin = new Role;
        $admin->setName('admin')
            ->setDescription('Grunt administrative access.')
            ->setIsSystem(true);

        $superadmin = new Role;
        $superadmin->setName('superadmin')
            ->setDescription('Administrative user, has access to everything.')
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

        $manager->persist($admin);
        $manager->persist($superadmin);
        $manager->persist($guest);
        $manager->persist($user);
        $manager->flush();
    }

    private function loadPermissions(ObjectManager $manager)
    {
        $permissions = $this->getPermissions();
        foreach ($permissions as $permission) {
            $name = Arr::get($permission, 'name');
            $description = Arr::get($permission, 'description');
            $object = new Permission($name);
            $object->setDescription($description)
                ->setIsSystem(true);
            $manager->persist($object);
            $manager->flush();
        }
        unset($permissions);
        return $manager->getRepository(Permission::class)->findAll();
    }

    private function getPermissions(): array
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
