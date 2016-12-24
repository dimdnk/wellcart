<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Repository;

use PHPUnit\Framework\TestCase;
use WellCart\Backend\Entity\Notification;

class NotificationsQueryTest extends TestCase
{
    /**
     * @var NotificationsQuery
     */
    private $object;

    public function setUp()
    {
        $em = application()
            ->getServiceManager()
            ->get('Doctrine\ORM\EntityManager');
        $this->object = (
        new NotificationsQuery(
            $em
        )
        )
            ->select('t')
            ->from(Notification::class, 't');
    }

    public function testRead()
    {
        $this->assertInstanceOf(
            NotificationsQuery::class,
            $this->object->read()
        );
    }

    public function testDeleted()
    {
        $this->assertInstanceOf(
            NotificationsQuery::class,
            $this->object->deleted()
        );
    }

    public function testRecent()
    {
        $this->assertCount(
            0,
            $this->object->recent()
        );
    }

    public function testDefaultScope()
    {
        $this->assertInstanceOf(
            NotificationsQuery::class,
            $this->object->defaultScope()
        );
    }

    public function testNotDeleted()
    {
        $this->assertInstanceOf(
            NotificationsQuery::class,
            $this->object->notDeleted()
        );
    }

    public function testNotRead()
    {
        $this->assertInstanceOf(
            NotificationsQuery::class,
            $this->object->notRead()
        );
    }
}
