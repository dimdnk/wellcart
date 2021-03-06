<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Test\Unit\Repository;

use WellCart\Test\TestCase;
use WellCart\Backend\Repository\Administrators;
use WellCart\Backend\Spec\AdministratorRepository;

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
