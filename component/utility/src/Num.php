<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Utility;

/**
 * Class containing number helper methods.
 */
abstract class Num
{
    /**
     * Converts arabic numerals (1-3999) to roman numerals.
     *
     * @param   int $int Arabic numeral to convert
     *
     * @return  string
     *
     * @throws Exception\InvalidArgumentException
     */
    public static function arabic2roman($int)
    {
        $int = (int)$int;

        if ($int < 1 || $int > 3999) {
            throw new Exception\InvalidArgumentException(
                vsprintf(
                    "%s(): The number must be between 1 and 3999.", [__METHOD__]
                )
            );
        }

        $numerals = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1
        ];

        $romanNumeral = '';

        foreach ($numerals as $roman => $arabic) {
            $count = (int)($int / $arabic);

            if ($count === 0) {
                continue;
            }

            $romanNumeral .= str_repeat($roman, $count);

            $int %= $arabic;

            if ($int === 0) {
                break;
            }
        }

        return $romanNumeral;
    }

    /**
     * Converts roman numerals (I-MMMCMXCIX) to arabic numerals.
     *
     * @param   string $str Roman numeral to convert
     *
     * @return  int
     *
     * @throws Exception\InvalidArgumentException
     */
    public static function roman2arabic($str)
    {
        if (empty($str)
            || preg_match(
                '/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/i',
                $str
            ) === 0
        ) {
            throw new Exception\InvalidArgumentException(
                vsprintf(
                    "%s(): Invalid roman numeral. Only values between I and MMMCMXCIX are allowed.",
                    [__METHOD__]
                )
            );
        }

        $numerals = [
            'M' => 1000,
            'D' => 500,
            'C' => 100,
            'L' => 50,
            'X' => 10,
            'V' => 5,
            'I' => 1
        ];

        $arabicNumeral = 0;

        $previous = 0;

        foreach (str_split($str) as $numeral) {
            $arabicNumeral += $numerals[$numeral];

            if ($previous < $numerals[$numeral]) {
                $arabicNumeral -= ($previous * 2);
            }

            $previous = $numerals[$numeral];
        }

        return $arabicNumeral;
    }
}