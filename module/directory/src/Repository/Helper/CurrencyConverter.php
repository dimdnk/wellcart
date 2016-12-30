<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Repository\Helper;

class CurrencyConverter
{
    /**
     * Url where Curl request is made
     *
     * @var string
     */
    const API_URL = 'http://download.finance.yahoo.com/d/quotes.csv?s=[fromCurrency][toCurrency]=X&f=nl1d1t1';

    /**
     * @param string $fromCurrency
     * @param string $toCurrency
     *
     * @return float|bool
     */
    public static function convert($fromCurrency, $toCurrency)
    {
        $fromCurrency = urlencode($fromCurrency);
        $toCurrency = urlencode($toCurrency);
        $url = str_replace(
            ['[fromCurrency]', '[toCurrency]'],
            [$fromCurrency, $toCurrency],
            static::API_URL
        );
        $ch = curl_init();
        $timeout = 2;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
            $ch,
            CURLOPT_USERAGENT,
            'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)'
        );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);
        if ($rawdata) {
            return doubleval(explode(',', $rawdata)[1]);
        }
        error_log(
            sprintf(
                '%s: We can\'t retrieve a currency rate from %s.',
                __METHOD__,
                $url
            )
        );
        return false;
    }
}
