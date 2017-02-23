<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\CMS\Test\Unit;

use PHPUnit\Framework\TestCase;
use WellCart\CMS\Module;
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
            ModuleConfiguration::class, $this->object->getConfig()
        );
        $_ENV['WELLCART_APPLICATION_CONTEXT'] = Application::CONTEXT_API;
        $this->assertInstanceOf(
            ModuleConfiguration::class, $this->object->getConfig()
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
}
