<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Money\I18n;

interface LocaleAwareInterface
{

    /**
     * Set Locale for this instance
     * @param  string               $locale
     * @return LocaleAwareInterface
     */
    public function setLocale($locale);

    /**
     * Return the set locale or the system wide default if not set
     * @return string
     */
    public function getLocale();

}
