<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Setup\Data;

use Doctrine\Common\Persistence\ObjectManager;
use WellCart\Base\Entity\Locale\Language;
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
        $language = new Language();
        $language->setName('English')
            ->setCode('en')
            ->setLocale('en_US')
            ->setTerritory('en')
            ->setIsSystem(true)
            ->setIsDefault(true)
            ->setIsActive(true)
            ->setSortOrder(0);
        $manager->persist($language);
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
    }

    private function getPermissions(): array
    {
        return [
            ['name' => 'base/languages/group-action-handler',],
            ['name' => 'base/languages/list',],
            ['name' => 'base/languages/view',],
            ['name' => 'base/languages/create',],
            ['name' => 'base/languages/update',],
            ['name' => 'base/languages/delete',],

            ['name' => 'base/url-rewrites/group-action-handler',],
            ['name' => 'base/url-rewrites/list',],
            ['name' => 'base/url-rewrites/view',],
            ['name' => 'base/url-rewrites/create',],
            ['name' => 'base/url-rewrites/update',],
            ['name' => 'base/url-rewrites/delete',],

            ['name' => 'admin/system-settings/acmailer_options/view',],
            ['name' => 'admin/system-settings/acmailer_options/update',],
            ['name' => 'admin/system-settings/advanced/view',],
            ['name' => 'admin/system-settings/advanced/update',],
        ];
    }
}
