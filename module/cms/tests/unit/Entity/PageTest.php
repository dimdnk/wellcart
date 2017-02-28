<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\CMS\Test\Unit\Entity;

use DateTime;
use WellCart\Test\TestCase;
use WellCart\CMS\Entity\Page;
use WellCart\CMS\Entity\PageI18n;
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
        parent::setUp();
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
            Page::class,
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
            Page::class,
            $this->object->setCreatedAt(new DateTime)
        );
    }

    public function testSetUpdatedAt()
    {
        $this->assertInstanceOf(
            Page::class,
            $this->object->setUpdatedAt(null)
        );

        $this->assertInstanceOf(
            Page::class,
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
            Page::class,
            $this->object->addTranslations($collection)
        );
    }

    public function testAddTranslation()
    {
        $translation = new PageI18n;
        $translation->setId(1);
        $this->assertInstanceOf(
            Page::class,
            $this->object->addTranslation($translation)
        );
        $this->assertInstanceOf(
            Page::class,
            $this->object->addTranslation($translation)
        );
    }

    public function testRemoveTranslations()
    {
        $collection = new ArrayCollection();
        $collection->add(new PageI18n());
        $this->assertInstanceOf(
            Page::class,
            $this->object->removeTranslations($collection)
        );
    }

    public function testRemoveTranslation()
    {
        $this->assertInstanceOf(
            Page::class,
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
            Page::class,
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
            Page::class,
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
            Page::class,
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
            Page::class,
            $this->object->setUrlKey('url_key')
        );
    }
}
