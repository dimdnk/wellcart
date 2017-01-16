<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\View\Helper;

use Carbon\Carbon as Formatter;
use Zend\View\Helper\AbstractHelper;

class Date extends AbstractHelper
{

    /**
     * @var string
     */
    protected $timezone;

    public function __construct(string $timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @param string $date
     * @param string $tz
     * @param string $format
     *
     * @return string
     */
    public function __invoke($date,
        $tz = null, $format = null
    ): string {
        if ($tz === null) {
            $tz = $this->getTimezone();
        }
        if ($format === null) {
            $format = Formatter::DEFAULT_TO_STRING_FORMAT;
        }

        $dt = new Formatter($date, 'UTC');
        $dt->setTimezone($tz);

        return $dt->format($format);
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     *
     * @return Date
     */
    public function setTimezone(string $timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }


}