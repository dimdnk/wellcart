<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Setup\Data;

use Doctrine\Common\Persistence\ObjectManager;
use WellCart\Setup\DataFixture\AbstractFixture;
use WellCart\User\Entity\Acl\Permission;
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
    }

    private function getPermissions(): array
    {
        return [
            ['name' => 'admin/dashboard/view',],
            ['name' => 'admin/system-settings/general/view',],
            ['name' => 'admin/system-settings/general/update',],
            ['name' => 'admin/accounts/group-action-handler',],
            ['name' => 'admin/accounts/list',],
            ['name' => 'admin/accounts/view',],
            ['name' => 'admin/accounts/create',],
            ['name' => 'admin/accounts/update',],
            ['name' => 'admin/accounts/delete',],
            ['name' => 'admin/notifications/group-action-handler',],
            ['name' => 'admin/notifications/list',],
            ['name' => 'admin/notifications/delete',],
            ['name' => 'admin/notifications/mark-as-read',],

        ];
    }
}
