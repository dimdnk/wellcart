<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Theme\SetupUi;

use PHPUnit_Framework_TestCase as TestCase;

class ModuleTest extends TestCase
{
    /**
     * @var Module
     */
    private $object;

    public function setUp()
    {
        $this->object = new Module();
    }

    public function testGetVersion()
    {
        $this->assertEquals(Module::VERSION, $this->object->getVersion());
    }

    public function testGetConfig()
    {
        $this->assertInternalType('array', $this->object->getConfig());
    }


    public function testGetAbsolutePath()
    {
        $this->assertTrue(is_dir($this->object->getAbsolutePath()));
    }

    public function testGetBlockConfig()
    {
        $this->assertInternalType('array', $this->object->getBlockConfig());
    }
}
