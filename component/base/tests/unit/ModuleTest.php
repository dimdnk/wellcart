<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;

use PHPUnit\Framework\TestCase;
use WellCart\ModuleManager\ModuleConfiguration;
use WellCart\Mvc\Application;

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

    public function testOnBootstrap()
    {
        $this->assertNull(
            $this->object->onBootstrap(application()->getMvcEvent())
        );
    }

    public function testGetConfig()
    {
        $this->assertInstanceOf(ModuleConfiguration::class, $this->object->getConfig());
        $_ENV['WELLCART_APPLICATION_CONTEXT'] = Application::CONTEXT_API;
        $this->assertInstanceOf(ModuleConfiguration::class, $this->object->getConfig());
    }

    public function testGetControllerConfig()
    {
        $this->assertInternalType(
            'array', $this->object->getControllerConfig()
        );
    }

    public function testGetServiceConfig()
    {
        $this->assertInternalType('array', $this->object->getServiceConfig());
    }

    public function testGetMigrations()
    {
        $this->assertInternalType('array', $this->object->getMigrations());
    }

    public function testGetDataFixtures()
    {
        $this->assertInternalType('array', $this->object->getDataFixtures());
    }

    public function testGetAbsolutePath()
    {
        $this->assertTrue(is_dir($this->object->getAbsolutePath()));
    }


    public function testGetControllerPluginConfig()
    {
        $this->assertInternalType(
            'array', $this->object->getControllerPluginConfig()
        );
    }

    public function testGetViewHelperConfig()
    {
        $this->assertInternalType(
            'array', $this->object->getViewHelperConfig()
        );
    }
}
