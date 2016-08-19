<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Repository;

use PHPUnit\Framework\TestCase;
use WellCart\Admin\Spec\AdministratorRepository;

class AdministratorsTest extends TestCase
{
    /**
     * @var Administrators
     */
    private $object;

    public function setUp()
    {
        $this->object = application()->getServiceManager()->get(
            AdministratorRepository::class
        );
    }

    public function testCountUsersWithRole()
    {
        $this->assertEquals(0, $this->object->countUsersWithRole('test'));
    }

    public function testGetUserIdsWithRole()
    {
        $this->assertEmpty($this->object->getUserIdsWithRole('test'));
    }
}
