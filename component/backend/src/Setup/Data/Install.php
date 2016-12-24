<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Setup\Data;

use Doctrine\Common\Persistence\ObjectManager;
use WellCart\Setup\DataFixture\AbstractFixture;
use WellCart\Setup\DataFixture\PermissionsProviderInterface;

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
    }

    public function getPermissionsDefinition(): array
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
