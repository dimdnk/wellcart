<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use PHPUnit\Framework\TestCase;

/**
 * DateTime helper test.
 *
 */
class TimeTest extends TestCase
{

    public function testConstructor()
    {
        $this->assertInstanceOf('WellCart\Utility\Time', new Time);
        $this->assertInstanceOf(
            'WellCart\Utility\Time', new Time(date('2000-m-d H:i:s'))
        );
        $this->assertInstanceOf(
            'WellCart\Utility\Time', new Time('now', 'UTC')
        );
    }

    public function testNow()
    {
        $this->assertInstanceOf('WellCart\Utility\Time', Time::now());
        $this->assertInstanceOf('WellCart\Utility\Time', Time::now('UTC'));
    }

    public function testCreateFromDate()
    {
        $date = Time::createFromDate(2000, 1, 1, 'UTC');
        $this->assertEquals('2000-01-01', $date->format('Y-m-d'));
    }

    public function testCreateFromTimestamp()
    {
        $date = Time::createFromTimestamp(time());
        $this->assertEquals(date('Y-m-d'), $date->format('Y-m-d'));
    }

    public function testCreateFromDOSTimestamp()
    {
        $time = Time::createFromDOSTimestamp('673251328');
        $this->assertEquals('2000-01-01', $time->format('Y-m-d'));
    }

    public function testCreateFromFormat()
    {
        $time = Time::createFromFormat('Y-m-d', '2000-01-01');
        $this->assertEquals('2000-01-01', $time->format('Y-m-d'));

        $time = Time::createFromFormat('Y-m-d', '2000-01-01', 'UTC');
        $this->assertEquals('2000-01-01', $time->format('Y-m-d'));
    }

    public function testSetTimeZone()
    {
        $time = new Time;
        $time->setTimeZone('Europe/Paris');
        $this->assertInstanceOf('DateTimeZone', $time->getTimezone());
    }

    public function testGetTimeZones()
    {
        $timezones = Time::getTimeZones();
        $this->assertTrue(count($timezones) > 400);
    }

    public function testGetGroupedTimeZones()
    {
        $groups = Time::getGroupedTimeZones();
        $this->assertCount(10, $groups);
    }

    public function testForward()
    {
        $time = new Time;
        $time->setTimeZone('UTC');
        $time->forward(60);
        $this->assertEquals(time() + 60, $time->getTimestamp());
    }

    public function testRewind()
    {
        $time = new Time;
        $time->setTimeZone('UTC');
        $time->rewind(120);
        $this->assertEquals(time() - 120, $time->getTimestamp());
    }

    public function testGetDOSTimestamp()
    {
        $time = new Time('2000-01-01 00:00:00');
        $this->assertEquals(673251328, $time->getDOSTimestamp());

        $time = new Time('1979-12-31 23:59:00');
        $this->assertEquals(2162688, $time->getDOSTimestamp());
    }

    public function testIsLeapYear()
    {
        $time = new Time('2000-01-01 00:00:00');
        $this->assertTrue($time->isLeapYear());

        $time = new Time('2001-01-01 00:00:00');
        $this->assertFalse($time->isLeapYear());
    }

    public function testDaysInMonth()
    {
        $time = new Time('2000-01-01 00:00:00');
        $this->assertEquals(31, $time->daysInMonth());
    }
}