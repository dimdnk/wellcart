<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\CMS\Test\Unit\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;
use WellCart\Base\Entity\Locale\Language;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\CMS\Entity\Page;
use WellCart\CMS\Entity\PageI18n;

class PageI18nTest extends TestCase
{

    /**
     * @var PageI18n
     */
    private $object;

    public function setUp()
    {
        $this->object = new PageI18n();
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
            PageI18n::class,
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
            PageI18n::class,
            $this->object->setCreatedAt(new DateTime)
        );
    }

    public function testSetUpdatedAt()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setUpdatedAt(null)
        );

        $this->assertInstanceOf(
            PageI18n::class,
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

    public function testGetMetaTitle()
    {
        $this->assertNull($this->object->getMetaTitle());
        $this->object->setMetaTitle('value');
        $this->assertEquals('value', $this->object->getMetaTitle());
    }

    public function setMetaTitle()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setMetaTitle('data')
        );
    }

    public function testGetPage()
    {
        $this->assertNull($this->object->getPage());
        $this->object->setPage(new Page());
        $this->assertInstanceOf(
            Page::class,
            $this->object->getPage()
        );
    }

    public function testSetPage()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setPage(null)
        );
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setPage(new Page)
        );
    }

    public function testGetLanguage()
    {
        $this->assertNull($this->object->getLanguage());
        $this->object->setLanguage(new Language());
        $this->assertInstanceOf(
            LocaleLanguageEntity::class,
            $this->object->getLanguage()
        );
    }

    public function testSetLanguage()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setLanguage(null)
        );
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setLanguage(new Language())
        );
    }

    public function testGetBody()
    {
        $this->assertNull($this->object->getBody());
        $this->object->setBody('value');
        $this->assertEquals('value', $this->object->getBody());
    }

    public function setBody()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setBody('data')
        );
    }

    public function testGetMetaDescription()
    {
        $this->assertNull($this->object->getMetaDescription());
        $this->object->setMetaDescription('value');
        $this->assertEquals('value', $this->object->getMetaDescription());
    }

    public function testSetMetaDescription()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setMetaDescription('data')
        );
    }

    public function testGetMetaKeywords()
    {
        $this->assertNull($this->object->getMetaKeywords());
        $this->object->setMetaKeywords('value');
        $this->assertEquals('value', $this->object->getMetaKeywords());
    }

    public function testSetMetaKeywords()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setMetaKeywords('data')
        );
    }

    public function testGetTitle()
    {
        $this->assertNull($this->object->getTitle());
        $this->object->setTitle('value');
        $this->assertEquals('value', $this->object->getTitle());
    }

    public function testSetTitle()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setTitle('data')
        );
    }

    public function testGetPageId()
    {
        $this->assertNull($this->object->getPageId());
        $this->object->setPageId(1);
        $this->assertEquals(1, $this->object->getPageId());
    }

    public function testSetPageId()
    {
        $this->assertInstanceOf(
            PageI18n::class,
            $this->object->setPageId(1)
        );
    }
}
