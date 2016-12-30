<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Setup\Data;

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
            ['name' => 'cms/pages/group-action-handler',],
            ['name' => 'cms/pages/list',],
            ['name' => 'cms/pages/view',],
            ['name' => 'cms/pages/create',],
            ['name' => 'cms/pages/update',],
            ['name' => 'cms/pages/delete',],
        ];
    }
}
