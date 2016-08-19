<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Setup\Data;

use Doctrine\Common\Persistence\ObjectManager;
use WellCart\RestApi\Entity\OAuth2\Scope;
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
        $scope = new Scope();
        $scope->setScope('global')
            ->setIsDefault(true);
        $manager->persist($scope);
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
            ['name' => 'api/configuration/view',],
            ['name' => 'api/oauth2-clients/group-action-handler',],
            ['name' => 'api/oauth2-clients/list',],
            ['name' => 'api/oauth2-clients/view',],
            ['name' => 'api/oauth2-clients/create',],
            ['name' => 'api/oauth2-clients/update',],
            ['name' => 'api/oauth2-clients/delete',],

            ['name' => 'api/oauth2-scopes/group-action-handler',],
            ['name' => 'api/oauth2-scopes/list',],
            ['name' => 'api/oauth2-scopes/view',],
            ['name' => 'api/oauth2-scopes/create',],
            ['name' => 'api/oauth2-scopes/update',],
            ['name' => 'api/oauth2-scopes/delete',],

            ['name' => 'api/oauth2-public-keys/group-action-handler',],
            ['name' => 'api/oauth2-public-keys/list',],
            ['name' => 'api/oauth2-public-keys/view',],
            ['name' => 'api/oauth2-public-keys/create',],
            ['name' => 'api/oauth2-public-keys/update',],
            ['name' => 'api/oauth2-public-keys/delete',],
        ];
    }
}
