<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    /**
     * @var Notification
     */
    private $object;

    public function setUp()
    {
        $this->object = new Notification();
    }

    /**
     * @return int
     */
    public function testGetId()
    {
        $this->assertNull($this->object->getId());
        $this->object->setId(1);
        $this->assertEquals(1, $this->object->getId());
    }

    public function testSetId()
    {
        $this->assertInstanceOf(
            Notification::class, $this->object->setId(1)
        );
    }

    public function testGetIcon()
    {
        $this->object->setIcon('test');
        $this->assertEquals('test', $this->object->getIcon());

    }

    public function testSetIcon()
    {
        $this->assertInstanceOf(
            Notification::class, $this->object->setIcon('test')
        );
    }

    public function testGetTitle()
    {
        $this->object->setTitle('test');
        $this->assertEquals('test', $this->object->getTitle());
    }


    public function testSetTitle()
    {
        $this->assertInstanceOf(
            Notification::class, $this->object->setTitle('test')
        );
    }


    public function testGetBody()
    {
        $this->object->setBody('test');
        $this->assertEquals('test', $this->object->getBody());

    }


    public function testSetBody()
    {
        $this->assertInstanceOf(
            Notification::class, $this->object->setBody('test')
        );
    }

    /**
     * @return boolean
     */
    public function testIsRead()
    {
        $this->assertFalse($this->object->isRead());
    }

    public function testSetIsRead()
    {
        $this->assertInstanceOf(
            Notification::class, $this->object->setIsRead('test')
        );
    }

    public function testIsDeleted()
    {
        $this->assertFalse($this->object->isDeleted());
    }

    public function testSetIsDeleted()
    {
        $this->assertInstanceOf(
            Notification::class, $this->object->setIsDeleted('test')
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
            Notification::class,
            $this->object->setCreatedAt(new DateTime)
        );
    }

    public function testSetUpdatedAt()
    {
        $this->assertInstanceOf(
            Notification::class,
            $this->object->setUpdatedAt(null)
        );

        $this->assertInstanceOf(
            Notification::class,
            $this->object->setUpdatedAt(new DateTime)
        );
    }

    public function testGetUpdatedAt()
    {
        $this->object->setUpdatedAt(new DateTime);
        $this->assertInstanceOf(
            'DateTimeInterface',
            $this->object->getUpdatedAt()
        );
    }


    public function testGetDeletedAt()
    {
        $this->object->setDeletedAt(new DateTime);
        $this->assertInstanceOf(
            'DateTimeInterface',
            $this->object->getDeletedAt()
        );

    }

    public function testSetDeletedAt()
    {
        $this->assertInstanceOf(
            Notification::class,
            $this->object->setDeletedAt(new DateTime)
        );
    }
}
