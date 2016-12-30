<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


namespace WellCart\Utility;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;

/**
 * Extension of the PHP DateTime class.
 */
class Time extends Carbon
{
    /**
     * Number of seconds in a minute.
     *
     * @var int
     */
    const MINUTE = 60;
    /**
     * Number of seconds in an hour.
     *
     * @var int
     */
    const HOUR = 3600;
    /**
     * Number of seconds in a day.
     *
     * @var int
     */
    const DAY = 86400;
    /**
     * Number of seconds in a week.
     *
     * @var int
     */
    const WEEK = 604800;
    /**
     * Average number of seconds in a month.
     *
     * @var int
     */
    const MONTH = 2629744;
    /**
     * Average number of seconds in a year.
     *
     * @var int
     */
    const YEAR = 31556926;

    /**
     * Constructor.
     *
     * @param string $time     (optional) A date/time string
     * @param mixed  $timeZone (optional) A valid time zone or a DateTimeZone object
     */
    public function __construct($time = 'now', $timeZone = null)
    {
        if ($timeZone !== null && !is_object($timeZone)) {
            $timeZone = new DateTimeZone($timeZone);
        }
        parent::__construct($time, $timeZone);
    }

    /**
     * Returns a new Time object.
     *
     * @param mixed $timeZone (optional) A valid time zone or a DateTimeZone object
     *
     * @return Time
     */
    public static function now($timeZone = null)
    {
        return new static('now', $timeZone);
    }

    /**
     * Returns new Time object according to the specified DOS timestamp.
     *
     * @param int    $timestamp DOS timestamp
     * @param string $timeZone  (optional) A valid time zone or a DateTimeZone object
     *
     * @return Time
     */
    public static function createFromDOSTimestamp($timestamp, $timeZone = null)
    {
        $year = (($timestamp >> 25) & 0x7f) + 1980;
        $mon = ($timestamp >> 21) & 0x0f;
        $mday = ($timestamp >> 16) & 0x1f;
        $hours = ($timestamp >> 11) & 0x1f;
        $minutes = ($timestamp >> 5) & 0x3f;
        $seconds = 2 * ($timestamp & 0x1f);
        $timestamp = mktime($hours, $minutes, $seconds, $mon, $mday, $year);
        return static::createFromTimestamp($timestamp, $timeZone);
    }

    /**
     * Returns new Time object according to the specified timestamp.
     *
     * @param int    $timestamp Unix timestamp
     * @param string $timeZone  (optional) A valid time zone or a DateTimeZone object
     *
     * @return Time
     */
    public static function createFromTimestamp($timestamp, $timeZone = null)
    {
        /**
         * @var $dateTime Time
         */
        $dateTime = new static('now', $timeZone);
        $dateTime->setTimestamp($timestamp);
        return $dateTime;
    }

    /**
     * Returns new Time object formatted according to the specified format.
     *
     * @param string $format   The format that the passed in string should be in
     * @param string $time     String representing the time
     * @param string $timeZone (optional) A valid time zone or a DateTimeZone object
     *
     * @return Time
     */
    public static function createFromFormat($format, $time, $timeZone = null)
    {
        if ($timeZone !== null) {
            if (!is_object($timeZone)) {
                $timeZone = new DateTimeZone($timeZone);
            }
            $dateTime = parent::createFromFormat($format, $time, $timeZone);
        } else {
            $dateTime = parent::createFromFormat($format, $time);
        }
        return static::createFromTimestamp(
            $dateTime->getTimestamp(), $dateTime->getTimeZone()
        );
    }

    /**
     * Returns a list of time zones where the key is
     * a valid PHP time zone while the value is a presentable name.
     *
     * @return array
     */
    public static function getTimeZones()
    {
        $timeZones = [];
        foreach (DateTimeZone::listIdentifiers() as $timeZone) {
            $timeZones[$timeZone] = str_replace('_', ' ', $timeZone);
        }
        return $timeZones;
    }

    /**
     * Returns an array of grouped time zones where the key is
     * a valid PHP timezone while the value is a presentable name.
     *
     * @return array
     */
    public static function getGroupedTimeZones()
    {
        $timeZones = [];
        foreach (DateTimeZone::listIdentifiers() as $timeZone) {
            list($group, $city) = explode('/', $timeZone, 2) + [null, null];
            $timeZones[$group][$timeZone] = str_replace('_', ' ', $city);
        }
        unset($timeZones['UTC']);
        return $timeZones;
    }

    /**
     * Sets the time zone for the Time object
     *
     * @param DateTimeZone $timeZone A valid time zone or a DateTimeZone object
     *
     * @return DateTime
     */
    public function setTimeZone($timeZone)
    {
        if (!is_object($timeZone)) {
            $timeZone = new DateTimeZone($timeZone);
        }
        return parent::setTimeZone($timeZone);
    }

    /**
     * Move forward in time by x seconds.
     *
     * @param int $seconds Number of seconds
     *
     * @return Time
     */
    public function forward($seconds)
    {
        $this->setTimestamp($this->getTimestamp() + $seconds);
        return $this;
    }

    /**
     * Move backward in time by x seconds.
     *
     * @param int $seconds Number of seconds
     *
     *
     * @return Time
     */
    public function rewind($seconds)
    {
        $this->setTimestamp($this->getTimestamp() - $seconds);
        return $this;
    }

    /**
     * Returns the DOS timestamp.
     *
     * @return int
     */
    public function getDOSTimestamp()
    {
        $time = getdate($this->getTimestamp());
        if ($time['year'] < 1980) {
            $time['year'] = 1980;
            $time['mon'] = 1;
            $time['mday'] = 1;
            $time['hours'] = 0;
            $time['minutes'] = 0;
            $time['seconds'] = 0;
        }
        return (($time['year'] - 1980) << 25) | ($time['mon'] << 21)
            | ($time['mday'] << 16) | ($time['hours'] << 11)
            | ($time['minutes'] << 5) | ($time['seconds'] >> 1);
    }

    /**
     * Returns the number of days in the current month.
     *
     * @return int
     */
    public function daysInMonth()
    {
        $days
            = [
            31,
            $this->isLeapYear() ? 29 : 28,
            31,
            30,
            31,
            30,
            31,
            31,
            30,
            31,
            30,
            31
        ];
        return $days[$this->format('n') - 1];
    }

    /**
     * Returns TRUE if the year is a leap year and FALSE if not.
     *
     * @return boolean
     */
    public function isLeapYear()
    {
        $year = $this->format('Y');
        if ($year % 400 === 0 || ($year % 4 === 0 && $year % 100 !== 0)) {
            return true;
        }
        return false;
    }
}