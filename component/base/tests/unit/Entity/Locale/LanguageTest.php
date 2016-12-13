<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Base\Entity\Locale;

use DateTime;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{

    /**
     * @var Language
     */
    private $object;

    public function setUp()
    {
        $this->object = new Language();
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
            'WellCart\Base\Entity\Locale\Language',
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
            'WellCart\Base\Entity\Locale\Language',
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
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setUpdatedAt(null)
        );

        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setUpdatedAt(new DateTime)
        );
    }

    public function testGetCode()
    {
        $this->assertNull($this->object->getCode());
        $this->object->setCode('code');
        $this->assertEquals('code', $this->object->getCode());
    }

    public function testSetCode()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setCode(null)
        );
    }

    public function testIsActive()
    {
        $this->assertFalse($this->object->isActive());
        $this->object->setIsActive(true);
        $this->assertTrue($this->object->isActive());
    }

    public function testSetIsActive()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setIsActive(true)
        );
    }

    public function testIsDefault()
    {
        $this->assertFalse($this->object->isDefault());
        $this->object->setIsDefault(true);
        $this->assertTrue($this->object->isDefault());
    }

    public function testSetIsDefault()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setIsDefault(true)
        );
    }

    public function testGetLocale()
    {
        $this->assertNull($this->object->getLocale());
        $this->object->setLocale('en_US');
        $this->assertEquals('en_US', $this->object->getLocale());
    }

    public function testSetLocale()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setLocale('en_US')
        );
    }

    public function testGetName()
    {
        $this->assertNull($this->object->getName());
        $this->object->setName('English');
        $this->assertEquals('English', $this->object->getName());
    }

    public function testSetName()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setName('English')
        );
    }

    public function testGetSortOrder()
    {
        $this->assertEquals(1, $this->object->getSortOrder());
        $this->object->setSortOrder(10);
        $this->assertEquals(10, $this->object->getSortOrder());
    }

    public function testSetSortOrder()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setSortOrder(1)
        );
    }

    public function testGetTerritory()
    {
        $this->assertNull($this->object->getTerritory());
        $this->object->setTerritory('en');
        $this->assertEquals('en', $this->object->getTerritory());
    }

    public function testSetTerritory()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setTerritory('en')
        );
    }

    public function testIsSystem()
    {
        $this->assertFalse($this->object->isSystem());
        $this->object->setIsSystem(true);
        $this->assertTrue($this->object->isSystem());
    }

    public function testSetIsSystem()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Locale\Language',
            $this->object->setIsSystem(true)
        );
    }
}
