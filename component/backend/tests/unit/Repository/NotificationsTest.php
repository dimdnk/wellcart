<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Test\Unit\Repository;

use PHPUnit\Framework\TestCase;
use WellCart\Backend\Repository\Notifications;
use WellCart\Backend\Repository\NotificationsQuery;
use WellCart\Backend\Spec\NotificationRepository;

class NotificationsTest extends TestCase
{

    /**
     * @var Notifications
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(NotificationRepository::class);
    }

    public function testFinder()
    {
        $this->assertInstanceOf(
            NotificationsQuery::class, $this->object->finder()
        );
    }

    public function testCreateQueryBuilder()
    {
        $this->assertInstanceOf(
            NotificationsQuery::class,
            $this->object->createQueryBuilder('TestEntity')
        );
    }

    public function testPerformGroupMarkAsRead()
    {
        $this->assertInternalType(
            'array',
            $this->object->performGroupMarkAsRead([])
        );
    }
}
