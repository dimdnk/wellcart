<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use PHPUnit\Framework\TestCase;

/**
 * Test for PHP Environment initializer
 *
 */
class PHPEnvironmentTest extends TestCase
{
    /**
     * @covers \WellCart\Utility\PHPEnvironment::initialize
     */
    public function testInitialize()
    {
        $this->assertTrue(PHPEnvironment::initialize());
        $this->assertTrue(defined('MCRYPT_RIJNDAEL_256'));
    }
}