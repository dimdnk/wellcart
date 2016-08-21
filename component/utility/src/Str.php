<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */



namespace WellCart\Utility;

use Patchwork\Utf8;
use URLify;

/**
 * Collection of string manipulation methods.
 */
class Str
{
    /**
     * Alphanumeric characters.
     *
     * @var string
     */
    const ALNUM = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * Alphabetic characters.
     *
     * @var string
     */
    const ALPHA = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    /**
     * Hexadecimal characters.
     *
     * @var string
     */
    const HEXDEC = '0123456789abcdef';
    /**
     * Numeric characters.
     *
     * @var string
     */
    const NUMERIC = '0123456789';
    /**
     * ASCII symbols.
     *
     * @var string
     */
    const SYMBOLS = '!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~';
    /**
     * Pluralization rules.
     *
     * @var array
     */
    protected static $pluralizationRules
        = [
            '/(quiz)$/i'                     => "$1zes",
            '/([m|l])ouse$/i'                => "$1ice",
            '/(.+)(e|i)x$/'                  => "$1ices",
            '/(z|x|ch|ss|sh)$/i'             => "$1es",
            '/([^aeiouy]|qu)y$/i'            => "$1ies",
            '/(hive)$/i'                     => "$1s",
            '/(?:([^f])fe|([lr])f)$/i'       => "$1$2ves",
            '/(shea|lea|loa|thie)f$/i'       => "$1ves",
            '/sis$/i'                        => "ses",
            '/([ti])um$/i'                   => "$1a",
            '/(tomat|potat|ech|her|vet)o$/i' => "$1oes",
            '/(bu)s$/i'                      => "$1ses",
            '/(octop|vir)us$/'               => "$1i",
            '/(ax|test)is$/i'                => "$1es",
            '/(us)$/i'                       => "$1es",
            '/((.*)(?<!hu))man$/i'           => "$1men",
            '/s$/i'                          => "s",
            '/$/'                            => "s",
        ];
    /**
     * Irregular noun.
     *
     * @var array
     */
    protected static $irregulars
        = [
            'alias'       => 'aliases',
            'audio'       => 'audio',
            'child'       => 'children',
            'deer'        => 'deer',
            'equipment'   => 'equipment',
            'fish'        => 'fish',
            'foot'        => 'feet',
            'goose'       => 'geese',
            'gold'        => 'gold',
            'information' => 'information',
            'money'       => 'money',
            'ox'          => 'oxen',
            'police'      => 'police',
            'series'      => 'series',
            'sex'         => 'sexes',
            'sheep'       => 'sheep',
            'species'     => 'species',
            'tooth'       => 'teeth',
        ];

    /**
     * Replaces newline with <br> or <br />.
     *
     * @param string  $string The input string
     * @param boolean $xhtml  (optional) Should we return XHTML?
     *
     * @return string
     */
    public static function nl2br($string, $xhtml = false)
    {
        return str_replace(
            ["\r\n", "\n\r", "\n", "\r"], ($xhtml) ? '<br />' : '<br>', $string
        );
    }

    /**
     * Replaces <br> and <br /> with newline.
     *
     * @param string $string The input string
     *
     * @return string
     */
    public static function br2nl($string)
    {
        return str_replace(['<br>', '<br/>', '<br />'], "\n", $string);
    }

    /**
     * Returns the plural form of a noun (english only).
     *
     * @param string $noun  Noun to pluralize
     * @param int    $count (optional) Number of nouns
     *
     * @return string
     */
    public static function pluralize($noun, $count = null)
    {
        if ($count !== 1) {
            if (isset(static::$irregulars[$noun])) {
                $noun = static::$irregulars[$noun];
            } else {
                foreach (static::$pluralizationRules as $search => $replace) {
                    if (preg_match($search, $noun)) {
                        $noun = preg_replace($search, $replace, $noun);
                        break;
                    }
                }
            }
        }
        return $noun;
    }

    /**
     * Converts underscored to camel case.
     *
     * @param string  $string The input string
     * @param boolean $upper  (optional) Return upper case camelCase?
     *
     * @return string
     */
    public static function underscored2camel($string, $upper = false)
    {
        return preg_replace_callback(
            ($upper ? '/(?:^|_)(.?)/u' : '/_(.?)/u'), function ($matches) {
            return mb_strtoupper($matches[1]);
        }, $string
        );
    }

    /**
     * Limits the number of characters in a string.
     *
     * @param string $string     The input string
     * @param int    $characters (optional) Number of characters to allow
     * @param string $sufix      (optional) Sufix to add if number of characters is reduced
     *
     * @return string
     */
    public static function limitChars(
        $string, $characters = 100, $sufix = '...'
    ) {
        return (mb_strlen($string) > $characters) ?
            trim(mb_substr($string, 0, $characters)) . $sufix : $string;
    }

    /**
     * Limits the number of words in a string.
     *
     * @param string $string The input string
     * @param int    $words  (optional) Number of words to allow
     * @param string $suffix (optional) Suffix to add if number of words is reduced
     *
     * @return string
     */
    public static function limitWords($string, $words = 100, $suffix = '...')
    {
        preg_match('/^\s*+(?:\S++\s*+){1,' . $words . '}/', $string, $matches);
        if (isset($matches[0]) && mb_strlen($matches[0]) < mb_strlen($string)) {
            return trim($matches[0]) . $suffix;
        }
        return $string;
    }

    /**
     * Creates url friendly string.
     *
     * @param string $string The input string
     *
     * @return string
     */
    public static function slug($string)
    {
        return mb_strtolower(URLify::filter($string));
    }

    /**
     * Strips all non-ASCII characters.
     *
     * @param string $string The input string
     *
     * @return string
     */
    public static function ascii($string)
    {
        return Utf8::toAscii($string);
    }

    /**
     * Returns a closure that will alternate between the defined strings.
     *
     * @param array $strings Array of strings to alternate between
     *
     * @return \Closure
     */
    public static function alternator(array $strings)
    {
        return function () use ($strings) {
            static $i = 0;
            return $strings[($i++ % count($strings))];
        };
    }

    /**
     * Returns a masked string where only the last n characters are visible.
     *
     * @param string $string  String to mask
     * @param int    $visible (optional) Number of characters to show
     * @param string $mask    (optional) Character used to replace remaining characters
     *
     * @return string
     */
    public static function mask($string, $visible = 3, $mask = '*')
    {
        if ($visible === 0) {
            return str_repeat($mask, mb_strlen($string));
        }
        $visible = mb_substr($string, -$visible);
        return str_pad(
            $visible,
            (mb_strlen($string) + (strlen($visible) - mb_strlen($visible))),
            $mask, STR_PAD_LEFT
        );
    }

    /**
     * Increments a string by appending a number to it or increasing the number.
     *
     * @param string $string    String to increment
     * @param int    $start     Starting number
     * @param string $separator Separator
     *
     * @return string
     */
    public static function increment($string, $start = 1, $separator = '_')
    {
        preg_match(
            '/(.+)' . preg_quote($separator) . '([0-9]+)$/', $string, $matches
        );
        return isset($matches[2]) ?
            $matches[1] . $separator . ((int)$matches[2] + 1)
            : $string . $separator . $start;
    }

    /**
     * Returns a random string of the selected type and length.
     *
     * @param string $pool   Character pool to use
     * @param int    $length (optional) Desired string length
     *
     * @return string
     */
    public static function random($pool = Str::ALNUM, $length = 32)
    {
        $string = '';
        $poolSize = mb_strlen($pool) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= mb_substr($pool, mt_rand(0, $poolSize), 1);
        }
        return $string;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param string       $haystack
     * @param string|array $needles
     *
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ((string)$needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Cap a string with a single instance of a given value.
     *
     * @param string $value
     * @param string $cap
     *
     * @return string
     */
    public static function finish($value, $cap)
    {
        $quoted = preg_quote($cap, '/');
        return preg_replace('/(?:' . $quoted . ')+$/', '', $value) . $cap;
    }

    /**
     * Determine if a given string matches a given pattern.
     *
     * @param string $pattern
     * @param string $value
     *
     * @return bool
     */
    public static function is($pattern, $value)
    {
        if ($pattern == $value) {
            return true;
        }
        $pattern = preg_quote($pattern, '#');
        // Asterisks are translated into zero-or-more regular expression wildcards
        // to make it convenient to check if the strings starts with the given
        // pattern such as "library/*", making any string check convenient.
        $pattern = str_replace('\*', '.*', $pattern) . '\z';
        return (bool)preg_match('#^' . $pattern . '#', $value);
    }

    /**
     * Parse a Class @ method style callback into class and method.
     *
     * @param string $callback
     * @param string $default
     *
     * @return array
     */
    public static function parseCallback($callback, $default)
    {
        return static::contains($callback, '@') ? explode('@', $callback, 2)
            : array($callback, $default);
    }

    /**
     * Determine if a given string contains a given substring.
     *
     * @param string       $haystack
     * @param string|array $needles
     *
     * @return bool
     */
    public static function contains($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && strpos($haystack, $needle) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Convert the given string to upper-case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function upper($value)
    {
        return mb_strtoupper($value);
    }

    /**
     * Convert the given string to title case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function title($value)
    {
        return mb_convert_case(
            str_replace('_', ' ', static::camel2underscored($value)),
            MB_CASE_TITLE, 'UTF-8'
        );
    }

    /**
     * Converts camel case to underscored.
     *
     * @param string $string The input string
     *
     * @return string
     */
    public static function camel2underscored($string)
    {
        return mb_strtolower(
            preg_replace('/([^A-Z])([A-Z])/u', "$1_$2", $string)
        );
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string       $haystack
     * @param string|array $needles
     *
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && strpos($haystack, $needle) === 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Convert the given string to lower-case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function lower($value)
    {
        return mb_strtolower($value);
    }

    /**
     * Binary-safe strrev()
     *
     * @param string $str
     *
     * @return string
     */
    public static function strrev($str)
    {
        $result = '';
        $strLen = static::length($str);
        if (!$strLen) {
            return $result;
        }
        for ($i = $strLen - 1; $i >= 0; $i--) {
            $result .= static::substr($str, $i, 1);
        }
        return $result;
    }

    /**
     * Return the length of the given string.
     *
     * @param string $value
     *
     * @return int
     */
    public static function length($value)
    {
        return mb_strlen($value);
    }

    /**
     * Pass through to iconv_substr()
     *
     * @param string $string
     * @param int    $offset
     * @param int    $length
     *
     * @return string
     */
    public static function substr($string, $offset, $length = null)
    {
        if (is_null($length)) {
            $length = static::length($string) - $offset;
        }
        return iconv_substr($string, $offset, $length, 'UTF-8');
    }

    /**
     * Find position of first occurrence of a string
     *
     * @param string $haystack
     * @param string $needle
     * @param int    $offset
     *
     * @return int|bool
     */
    public static function strpos($haystack, $needle, $offset = null)
    {
        return iconv_strpos($haystack, $needle, $offset, 'UTF-8');
    }
}