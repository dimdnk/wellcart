<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

return [
  'wellcart' =>
    array(
      'money' => array(

        /**
         * Seed the Currency List service with an array of allowed currencies.
         * This will limit what is available to select elements by default and what
         * is considered valid by the currency validator
         * @see \WellCart\Money\Service\CurrencyList
         * @see \WellCart\Money\Form\Element\SelectCurrency
         * @see \WellCart\Money\Validator\CurrencyCode
         * Also look at the factories for these
         */
        //'allow_currencies' => array(
        //    'GBP', 'USD', 'EUR', 'JPY', 'CAD', 'AUD', 'NZD', 'HKD'
        //),
        'allow_currencies' => null,

        /**
         * If allowCurrencies is set, this option makes little sense. It will
         * remove each code from those available by default in form elements and validators
         * In custom config, you can set 'allowCurrencies' to null
         */
        // 'excludeCurrencies' => array(
        //    'ADB', 'CHE', 'CHW', 'MXV', 'USN', 'USS', 'UYI', 'XAG', 'XAU', 'XBA', 'XBB', 'XBC', 'XBD', 'XDR', 'XFU', 'XPD', 'XPT', 'XSU', 'XTS', 'XUA', 'XXX',
        // ),
        'exclude_currencies' => null,

      )
    )
];
