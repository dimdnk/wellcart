<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Base\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;
use WellCart\Base\Spec\UrlRewriteEntity;

class UrlRewriteTest extends TestCase
{

    /**
     * @var UrlRewrite
     */
    private $object;

    public function setUp()
    {
        $this->object = new UrlRewrite();
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
            UrlRewriteEntity::class,
            $this->object->setId(1)
        );
    }

    public function testGetRequestPath()
    {
        $this->assertNull($this->object->getRequestPath());
        $this->object->setRequestPath('path');
        $this->assertEquals('path', $this->object->getRequestPath());
    }

    public function testSetRequestPath()
    {
        $this->assertInstanceOf(
            UrlRewriteEntity::class,
            $this->object->setRequestPath('path')
        );
    }

    public function testGetTargetPath()
    {
        $this->assertNull($this->object->getTargetPath());
        $this->object->setTargetPath('path');
        $this->assertEquals('path', $this->object->getTargetPath());
    }

    public function testSetTargetPath()
    {
        $this->assertInstanceOf(
            UrlRewriteEntity::class,
            $this->object->setTargetPath('path')
        );
    }

    public function testIsSystem()
    {
        $this->assertFalse($this->object->isSystem());
    }

    public function testSetIsSystem()
    {
        $this->assertInstanceOf(
            UrlRewriteEntity::class,
            $this->object->setIsSystem(true)
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
            UrlRewriteEntity::class,
            $this->object->setCreatedAt(new DateTime)
        );
    }

    public function testSetUpdatedAt()
    {
        $this->assertInstanceOf(
            UrlRewriteEntity::class,
            $this->object->setUpdatedAt(null)
        );

        $this->assertInstanceOf(
            UrlRewriteEntity::class,
            $this->object->setUpdatedAt(new DateTime)
        );
    }
}
