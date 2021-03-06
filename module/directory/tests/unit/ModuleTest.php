<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Directory\Test\Unit;

use WellCart\Test\TestCase;
use WellCart\Directory\Module;
use WellCart\ModuleManager\ModuleConfigProvider;
use WellCart\Mvc\Application;
use Zend\Console\Console;

class ModuleTest extends TestCase
{

    /**
     * @var Module
     */
    private $object;

    public function setUp()
    {
        parent::setUp();
        $this->object = new Module();
    }

    public function testGetVersion()
    {
        $this->assertEquals(Module::VERSION, $this->object->getVersion());
    }

    public function testGetConfig()
    {
        $this->assertInstanceOf(
            ModuleConfigProvider::class, $this->object->getConfig()
        );
        $_ENV['WELLCART_APPLICATION_CONTEXT'] = Application::CONTEXT_API;
        $this->assertInstanceOf(
            ModuleConfigProvider::class, $this->object->getConfig()
        );
    }

    public function testGetServiceConfig()
    {
        $this->assertInternalType('array', $this->object->getServiceConfig());
    }

    public function testGetSetupMigrations()
    {
        $this->assertInternalType('array', $this->object->getSetupMigrations());
    }

    public function testGetSetupDataFixtures()
    {
        $this->assertInternalType(
            'array', $this->object->getSetupDataFixtures()
        );
    }

    public function testGetAbsolutePath()
    {
        $this->assertTrue(is_dir($this->object->getAbsolutePath()));
    }

    public function testGetConsoleUsage()
    {
        $this->assertInternalType(
            'array', $this->object->getConsoleUsage(Console::getInstance())
        );
    }
}
