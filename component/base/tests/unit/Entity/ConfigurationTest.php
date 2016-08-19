<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{

    /**
     * @var Configuration
     */
    private $object;

    public function setUp()
    {
        $this->object = new Configuration();
    }

    public function testGetConfigKey()
    {
        $this->assertEquals('', $this->object->getConfigKey());
        $this->object->setConfigKey('key');
        $this->assertEquals('key', $this->object->getConfigKey());
    }

    public function testSetConfigKey()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Configuration',
            $this->object->setConfigKey('')
        );
    }

    public function testGetConfigValue()
    {
        $this->assertEquals('', $this->object->getConfigValue());
        $this->object->setConfigValue('value');
        $this->assertEquals('value', $this->object->getConfigValue());
    }

    public function testSetConfigValue()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Configuration',
            $this->object->setConfigValue('')
        );
    }

    public function testGetCreatedAt()
    {
        $this->object->setCreatedAt(new DateTime);
        $this->assertInstanceOf(
            'DateTimeInterface',
            $this->object->getCreatedAt()
        );
    }

    public function testSetCreatedAt()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Configuration',
            $this->object->setCreatedAt(new DateTime)
        );
    }

    public function testGetId()
    {
        $this->assertNull($this->object->getId());
        $this->object->setId(1);
        $this->assertEquals(1, $this->object->getId());
    }

    public function testSetId()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Configuration',
            $this->object->setId(1)
        );
    }

    public function testGetUpdatedAt()
    {
        $this->assertNull($this->object->getUpdatedAt());
        $this->object->setUpdatedAt(new DateTime);
        $this->assertInstanceOf(
            'DateTimeInterface',
            $this->object->getUpdatedAt()
        );
    }

    public function testSetUpdatedAt()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Configuration',
            $this->object->setUpdatedAt(new DateTime)
        );
    }
}
