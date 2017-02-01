<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Base\Test\Unit\Entity\Queue;

use DateTime;
use PHPUnit\Framework\TestCase;
use WellCart\Base\Entity\Queue\Job;

class JobTest extends TestCase
{

    /**
     * @var Job
     */
    private $object;

    public function setUp()
    {
        $this->object = new Job();
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
            'WellCart\Base\Entity\Queue\Job',
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
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setId(1)
        );
    }

    public function testGetQueue()
    {
        $this->assertNull($this->object->getQueue());
        $this->object->setQueue('queue');
        $this->assertEquals('queue', $this->object->getQueue());
    }

    public function testSetQueue()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setQueue('queue')
        );
    }

    public function testGetData()
    {
        $this->assertNull($this->object->getData());
        $this->object->setData('data');
        $this->assertEquals('data', $this->object->getData());
    }

    public function testSetData()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setData('data')
        );
    }

    public function testGetStatus()
    {
        $this->assertNull($this->object->getStatus());
        $this->object->setStatus(1);
        $this->assertEquals(1, $this->object->getStatus());
    }

    public function testSetStatus()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setStatus(1)
        );
    }

    public function testGetMessage()
    {
        $this->assertNull($this->object->getMessage());
        $this->object->setMessage('message');
        $this->assertEquals('message', $this->object->getMessage());
    }

    public function testSetMessage()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setMessage('message')
        );
    }

    public function testGetTrace()
    {
        $this->assertNull($this->object->getTrace());
        $this->object->setTrace('trace');
        $this->assertEquals('trace', $this->object->getTrace());
    }

    public function testSetTrace()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setTrace('trace')
        );
    }

    public function testGetScheduledAt()
    {
        $this->assertNull($this->object->getScheduledAt());
        $this->object->setScheduledAt(new DateTime);
        $this->assertInstanceOf(
            'DateTimeInterface',
            $this->object->getScheduledAt()
        );
    }

    public function testSetScheduledAt()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setScheduledAt(null)
        );
    }

    public function testGetExecutedAt()
    {
        $this->assertNull($this->object->getExecutedAt());
        $this->object->setExecutedAt(new DateTime);
        $this->assertInstanceOf(
            'DateTimeInterface',
            $this->object->getExecutedAt()
        );
    }

    public function testSetExecutedAt()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setExecutedAt(null)
        );
    }

    public function testGetFinishedAt()
    {
        $this->assertNull($this->object->getFinishedAt());
        $this->object->setFinishedAt(new DateTime);
        $this->assertInstanceOf(
            'DateTimeInterface',
            $this->object->getFinishedAt()
        );
    }

    public function testSetFinishedAt()
    {
        $this->assertInstanceOf(
            'WellCart\Base\Entity\Queue\Job',
            $this->object->setFinishedAt(null)
        );
    }
}
