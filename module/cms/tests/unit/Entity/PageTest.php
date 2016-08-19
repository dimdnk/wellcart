<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\CMS\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;
use WellCart\CMS\Spec\PageEntity;
use WellCart\Stdlib\Collection\ArrayCollection;

class PageTest extends TestCase
{

    /**
     * @var Page
     */
    private $object;

    public function setUp()
    {
        $this->object = new Page();
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
            'WellCart\CMS\Entity\Page',
            $this->object->setId(1)
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
            'WellCart\CMS\Entity\Page',
            $this->object->setCreatedAt(new DateTime)
        );
    }

    public function testSetUpdatedAt()
    {
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->setUpdatedAt(null)
        );

        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->setUpdatedAt(new DateTime)
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

    public function testAddTranslations()
    {
        $collection = new ArrayCollection();
        $collection->add(new PageI18n());
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->addTranslations($collection)
        );
    }

    public function testAddTranslation()
    {
        $translation = new PageI18n;
        $translation->setId(1);
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->addTranslation($translation)
        );
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->addTranslation($translation)
        );
    }

    public function testRemoveTranslations()
    {
        $collection = new ArrayCollection();
        $collection->add(new PageI18n());
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->removeTranslations($collection)
        );
    }

    public function testRemoveTranslation()
    {
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->removeTranslation(new PageI18n)
        );
    }

    public function testIsVisible()
    {
        $this->assertTrue($this->object->isVisible());
    }

    public function testGetStatus()
    {
        $this->assertEquals(
            PageEntity::STATUS_VISIBLE,
            $this->object->getStatus()
        );
    }

    public function testSetStatus()
    {
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->setStatus(PageEntity::STATUS_HIDDEN)
        );
    }

    public function testIsHidden()
    {
        $this->assertFalse($this->object->isHidden());
    }

    public function testClone()
    {
        $cloned = clone $this->object;
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $cloned
        );
    }

    public function testGetTranslations()
    {
        $this->assertInstanceOf(
            'Doctrine\Common\Collections\Collection',
            $this->object->getTranslations()
        );
    }

    public function testSetTranslations()
    {
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->setTranslations(new ArrayCollection())
        );
    }

    public function testGetUrlKey()
    {
        $this->assertNull($this->object->getUrlKey());
        $this->object->setUrlKey('value');
        $this->assertEquals('value', $this->object->getUrlKey());
    }

    public function testSetUrlKey()
    {
        $this->assertInstanceOf(
            'WellCart\CMS\Entity\Page',
            $this->object->setUrlKey('url_key')
        );
    }
}
