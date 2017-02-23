<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Test\Unit\Entity;

use WellCart\Test\TestCase;
use WellCart\Backend\Entity\Administrator;

class AdministratorTest extends TestCase
{

    /**
     * @var Administrator
     */
    private $object;

    public function setUp()
    {
      parent::setUp();
        $this->object = new Administrator();
    }

    public function testSetEmailConfirmationToken()
    {
        $this->object->setEmailConfirmationToken('foo');
        $this->assertNull($this->object->getEmailConfirmationToken());

    }
}
