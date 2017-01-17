<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use ArrayObject;
use PHPUnit\Framework\TestCase;

class ValidTest extends TestCase
{

    protected static $hasInternet;

    /**
     * Provides test data for test_alpha()
     *
     * @return array
     */
    public function providerAlpha()
    {
        return [
            ['asdavafaiwnoabwiubafpowf', true],
            ['!aidhfawiodb', false],
            ['51535oniubawdawd78', false],
            ['!"£$(G$W£(HFW£F(HQ)"n', false],
            // UTF-8 tests
            ['あいうえお', true, true],
            ['¥', false, true],
            // Empty test
            ['', false, false],
            [null, false, false],
            [false, false, false],
        ];
    }

    /**
     * Tests Valid::alpha()
     *
     * Checks whether a string consists of alphabetical characters only.
     *
     * @dataProvider providerAlpha
     *
     * @param string  $string
     * @param boolean $expected
     * @param bool    $utf8
     */
    public function testAlpha($string, $expected, $utf8 = false)
    {
        $this->assertSame(
            $expected,
            Valid::alpha($string, $utf8)
        );
    }

    /*
     * Provides test data for testAlphaNumeric
     */
    public function provideAlphaNumeric()
    {
        return [
            ['abcd1234', true],
            ['abcd', true],
            ['1234', true],
            ['abc123&^/-', false],
            // UTF-8 tests
            ['あいうえお', true, true],
            ['零一二三四五', true, true],
            ['あい四五£^£^', false, true],
            // Empty test
            ['', false, false],
            [null, false, false],
            [false, false, false],
        ];
    }

    /**
     * Tests Valid::alpha_numeric()
     *
     * Checks whether a string consists of alphabetical characters and numbers only.
     *
     * @dataProvider provideAlphaNumeric
     *
     * @param string  $input    The string to test
     * @param boolean $expected Is $input valid
     * @param bool    $utf8
     */
    public function testAlphaNumeric($input, $expected, $utf8 = false)
    {
        $this->assertSame(
            $expected,
            Valid::alphaNumeric($input, $utf8)
        );
    }

    /**
     * Provides test data for testAlphaDash
     */
    public function providerAlphaDash()
    {
        return [
            ['abcdef', true],
            ['12345', true],
            ['abcd1234', true],
            ['abcd1234-', true],
            ['abc123&^/-', false],
            // Empty test
            ['', false],
            [null, false],
            [false, false],
        ];
    }

    /**
     * Tests Valid::alphaDash()
     *
     * Checks whether a string consists of alphabetical characters, numbers, underscores and dashes only.
     *
     * @dataProvider providerAlphaDash
     *
     * @param string  $input        The string to test
     * @param boolean $containsUtf8 Does the string contain utf8 specific characters
     * @param boolean $expected     Is $input valid?
     */
    public function testAlphaDash($input, $expected, $containsUtf8 = false)
    {
        if (!$containsUtf8) {
            $this->assertSame(
                $expected,
                Valid::alphaDash($input)
            );
        }

        $this->assertSame(
            $expected,
            Valid::alphaDash($input, true)
        );
    }

    /**
     * DataProvider for the valid::date() test
     */
    public function providerDate()
    {
        return [
            ['now', true],
            ['10 September 2010', true],
            ['+1 day', true],
            ['+1 week', true],
            ['+1 week 2 days 4 hours 2 seconds', true],
            ['next Thursday', true],
            ['last Monday', true],

            ['blarg', false],
            ['in the year 2000', false],
            ['324824', false],
            // Empty test
            ['', false],
            [null, false],
            [false, false],
        ];
    }

    /**
     * Tests Valid::date()
     *
     * @dataProvider providerDate
     *
     * @param string  $date The date to validate
     * @param integer $expected
     */
    public function testDate($date, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::date($date, $expected)
        );
    }

    /**
     * DataProvider for the valid::decimal() test
     */
    public function providerDecimal()
    {
        return [
            // Empty test
            ['', 2, null, false],
            [null, 2, null, false],
            [false, 2, null, false],
            ['45.1664', 3, null, false],
            ['45.1664', 4, null, true],
            ['45.1664', 4, 2, true],
            ['-45.1664', 4, null, true],
            ['+45.1664', 4, null, true],
            ['-45.1664', 3, null, false],
        ];
    }

    /**
     * Tests Valid::decimal()
     *
     * @dataProvider providerDecimal
     *
     * @param string  $decimal  The decimal to validate
     * @param integer $places   The number of places to check to
     * @param integer $digits   The number of digits preceding the point to check
     * @param boolean $expected Whether $decimal conforms to $places AND $digits
     */
    public function testDecimal($decimal, $places, $digits, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::decimal($decimal, $places, $digits),
            'Decimal: "' . $decimal . '" to ' . $places . ' places and '
            . $digits . ' digits (preceeding period)'
        );
    }

    /**
     * Provides test data for test_digit
     *
     * @return array
     */
    public function providerDigit()
    {
        return [
            ['12345', true],
            ['10.5', false],
            ['abcde', false],
            ['abcd1234', false],
            ['-5', false],
            [-5, false],
            // Empty test
            ['', false],
            [null, false],
            [false, false],
        ];
    }

    /**
     * Tests Valid::digit()
     *
     * @dataProvider providerDigit
     *
     * @param mixed   $input    Input to validate
     * @param boolean $expected Is $input valid
     * @param bool    $containsUtf8
     */
    public function testDigit($input, $expected, $containsUtf8 = false)
    {
        if (!$containsUtf8) {
            $this->assertSame(
                $expected,
                Valid::digit($input)
            );
        }

        $this->assertSame(
            $expected,
            Valid::digit($input, true)
        );

    }

    /**
     * DataProvider for the valid::color() test
     */
    public function providerColor()
    {
        return [
            ['#000000', true],
            ['#GGGGGG', false],
            ['#AbCdEf', true],
            ['#000', true],
            ['#abc', true],
            ['#DEF', true],
            ['000000', true],
            ['GGGGGG', false],
            ['AbCdEf', true],
            ['000', true],
            ['DEF', true],
            // Empty test
            ['', false],
            [null, false],
            [false, false],
        ];
    }

    /**
     * Tests Valid::color()
     *
     * @dataProvider providerColor
     *
     * @param string  $color    The color to test
     * @param boolean $expected Is $color valid
     */
    public function testColor($color, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::color($color)
        );
    }

    public function providerLuhn()
    {
        return [
            ['4222222222222', true],
            ['4012888888881881', true],
            ['5105105105105100', true],
            ['6011111111111117', true],
            ['60111111111111.7', false],
            ['6011111111111117X', false],
            ['6011111111111117 ', false],
            ['WORD ', false],
            // Empty test
            ['', false],
            [null, false],
            [false, false],
        ];
    }

    /**
     * Tests Valid::luhn()
     *
     * @dataProvider  providerLuhn()
     *
     * @param string  $number Credit card number
     * @param boolean $expected
     */
    public function testLuhn($number, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::luhn($number)
        );
    }

    /**
     * Provides test data for testEmail()
     *
     * @return array
     */
    public function providerEmail()
    {
        return [
            ['foo', true, false],
            ['foo', false, false],

            ['foo@bar', true, true],
            // RFC is less strict than the normal regex, presumably to allow
            //  admin@localhost, therefore we IGNORE IT!!!
            ['foo@bar', false, false],
            ['foo@bar.com', false, true],
            ['foo@barcom:80', false, false],
            ['foo@bar.sub.com', false, true],
            ['foo+asd@bar.sub.com', false, true],
            ['foo.asd@bar.sub.com', false, true],
            // Empty test
            ['', true, false],
            [null, true, false],
            [false, true, false],
        ];
    }

    /**
     * Tests Valid::email()
     *
     * Check an email address for correct format.
     *
     * @dataProvider providerEmail
     *
     * @param string  $email   Address to check
     * @param boolean $strict  Use strict settings
     * @param boolean $correct Is $email address valid?
     */
    public function testEmail($email, $strict, $correct)
    {
        $this->assertSame(
            $correct,
            Valid::email($email, $strict)
        );
    }

    /**
     * Returns test data for testEmailDomain()
     *
     * @return array
     */
    public function providerEmailDomain()
    {
        return [
            ['google.com', true],
            // Don't anybody dare register this...
            ['DAWOMAWIDAIWNDAIWNHDAWIHDAIWHDAIWOHDAIOHDAIWHD.com', false],
            // Empty test
            ['', false],
            [null, false],
            [false, false],
        ];
    }

    /**
     * Tests Valid::email_domain()
     *
     * Validate the domain of an email address by checking if the domain has a
     * valid MX record.
     *
     * Test skips on windows
     *
     * @dataProvider providerEmailDomain
     *
     * @param string  $email   Email domain to check
     * @param boolean $correct Is it correct?
     */
    public function testEmailDomain($email, $correct)
    {
        if (!$this->hasInternet()) {
            $this->markTestSkipped(
                'An internet connection is required for this test'
            );
        }

        $this->assertSame(
            $correct,
            Valid::emailDomain($email)
        );

    }

    /**
     * Check for internet connectivity
     *
     * @return boolean Whether an internet connection is available
     */
    protected function hasInternet()
    {
        if (self::$hasInternet == null) {
            // The @ operator is used here to avoid DNS errors when there is no connection.
            $sock = @fsockopen("www.google.com", 80, $errno, $errstr, 1);
            self::$hasInternet = (bool)$sock ? true : false;
        }

        return self::$hasInternet;

    }

    /**
     * Provides data for testExactLength()
     *
     * @return array
     */
    public function providerExactLength()
    {
        return [
            ['somestring', 10, true],
            ['somestring', 11, false],
            ['anotherstring', 13, true],
            // Empty test
            ['', 10, false],
            [null, 10, false],
            [false, 10, false],
            // Test array of allowed lengths
            ['somestring', [1, 3, 5, 7, 9, 10], true],
            ['somestring', [1, 3, 5, 7, 9], false],
        ];
    }

    /**
     *
     * Tests Valid::exactLength()
     *
     * Checks that a field is exactly the right length.
     *
     * @dataProvider providerExactLength
     *
     * @param string  $string  The string to length check
     * @param integer $length  The length of the string
     * @param boolean $correct Is $length the actual length of the string?
     *
     * @return bool
     */
    public function testExactLength($string, $length, $correct)
    {
        return $this->assertSame(
            $correct,
            Valid::exactLength($string, $length),
            'Reported string length is not correct'
        );
    }

    /**
     * Provides data for test_equals()
     *
     * @return array
     */
    public function providerEquals()
    {
        return [
            ['foo', 'foo', true],
            ['1', '1', true],
            [1, '1', false],
            ['011', 011, false],
            // Empty test
            ['', 123, false],
            [null, 123, false],
            [false, 123, false],
        ];
    }

    /**
     * Tests Valid::equals()
     *
     * @dataProvider providerEquals
     *
     * @param   string  $string   value to check
     * @param   integer $required required value
     * @param   boolean $correct  is $string the same as $required?
     *
     * @return  boolean
     */
    public function testEquals($string, $required, $correct)
    {
        return $this->assertSame(
            $correct,
            Valid::equals($string, $required),
            'Values are not equal'
        );
    }

    /**
     * DataProvider for the valid::ip() test
     *
     * @return array
     */
    public function providerIp()
    {
        return [
            ['75.125.175.50', false, true],
            ['256.257.258.259', false, false],
            ['255.255.255.255', false, false],
            ['192.168.0.1', false, false],
            // Empty test
            ['', true, false],
            [null, true, false],
            [false, true, false],
        ];
    }

    /**
     * Tests Valid::ip()
     *
     * @dataProvider  providerIp
     *
     * @param string  $inputIp
     * @param boolean $allowPrivate
     * @param boolean $expectedResult
     */
    public function testIp($inputIp, $allowPrivate, $expectedResult)
    {
        $this->assertEquals(
            $expectedResult,
            Valid::ip($inputIp, $allowPrivate)
        );
    }

    /**
     * Returns test data for testMaxLength()
     *
     * @return array
     */
    public function providerMaxLength()
    {
        return [
            // Border line
            ['some', 4, true],
            // Exceeds
            ['UPPERCASEDEMO', 2, false],
            // Under
            ['SnakeCaseDemo', 13, true],
            // Empty test
            ['', -10, false],
            [null, -10, false],
            [false, -10, false],
        ];
    }

    /**
     * Tests Valid::maxLength()
     *
     * Checks that a field is short enough.
     *
     * @dataProvider providerMaxLength
     *
     * @param string  $string    String to test
     * @param integer $maxlength Max length for this string
     * @param boolean $correct   Is $string <= $maxlength
     */
    public function testMaxLength($string, $maxlength, $correct)
    {
        $this->assertSame(
            $correct,
            Valid::maxLength($string, $maxlength)
        );
    }

    /**
     * Returns test data for testMinLength()
     *
     * @return array
     */
    public function providerMinLength()
    {
        return [
            ['This is obviously long enough', 10, true],
            ['This is not', 101, false],
            ['This is on the borderline', 25, true],
            // Empty test
            ['', 10, false],
            [null, 10, false],
            [false, 10, false],
        ];
    }

    /**
     * Tests Valid::minLength()
     *
     * Checks that a field is long enough.
     *
     * @dataProvider providerMinLength
     *
     * @param string  $string    String to compare
     * @param integer $minlength The minimum allowed length
     * @param boolean $correct   Is $string 's length >= $minlength
     */
    public function testMinLength($string, $minlength, $correct)
    {
        $this->assertSame(
            $correct,
            Valid::minLength($string, $minlength)
        );
    }

    /**
     * Returns test data for testNotEmpty()
     *
     * @return array
     */
    public function providerNotEmpty()
    {
        // Create a blank arrayObject
        $ao = new ArrayObject;

        // arrayObject with value
        $ao1 = new ArrayObject;
        $ao1['test'] = 'value';

        return [
            [[], false],
            [null, false],
            ['', false],
            [$ao, false],
            [$ao1, true],
            [[null], true],
            [0, true],
            ['0', true],
            ['Something', true],
        ];
    }

    /**
     * Tests Valid::notEmpty()
     *
     * Checks if a field is not empty.
     *
     * @dataProvider providerNotEmpty
     *
     * @param mixed   $value Value to check
     * @param boolean $empty Is the value really empty?
     */
    public function testNotEmpty($value, $empty)
    {
        return $this->assertSame(
            $empty,
            Valid::notEmpty($value)
        );
    }

    /**
     * DataProvider for the Valid::numeric() test
     */
    public function providerNumeric()
    {
        return [
            [12345, true],
            [123.45, true],
            ['12345', true],
            ['10.5', true],
            ['-10.5', true],
            ['10.5a', false],
            // @issue 3240
            [.4, true],
            [-.4, true],
            [4., true],
            [-4., true],
            ['.5', true],
            ['-.5', true],
            ['5.', true],
            ['-5.', true],
            ['.', false],
            ['1.2.3', false],
            // Empty test
            ['', false],
            [null, false],
            [false, false],
        ];
    }

    /**
     * Tests Valid::numeric()
     *
     * @dataProvider providerNumeric
     *
     * @param string  $input    Input to test
     * @param boolean $expected Whether or not $input is numeric
     */
    public function testNumeric($input, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::numeric($input)
        );
    }

    /**
     * Provides test data for test_phone()
     *
     * @return array
     */
    public function providerPhone()
    {
        return [
            ['0163634840', null, true],
            ['+27173634840', null, true],
            ['123578', null, false],
            // Some uk numbers
            ['01234456778', null, true],
            ['+0441234456778', null, false],
            // Google UK case you're interested
            ['+44 20-7031-3000', [12], true],
            // BT Corporate
            ['020 7356 5000', null, true],
            // Empty test
            ['', null, false],
            [null, null, false],
            [false, null, false],
        ];
    }

    /**
     * Tests Valid::phone()
     *
     * @dataProvider  providerPhone
     *
     * @param $phone
     * @param $lengths
     * @param $expected
     */
    public function testPhone($phone, $lengths, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::phone($phone, $lengths)
        );
    }

    /**
     * DataProvider for the valid::regex() test
     */
    public function providerRegex()
    {
        return [
            ['hello world', '/[a-zA-Z\s]++/', true],
            ['123456789', '/[0-9]++/', true],
            ['£$%£%', '/[abc]/', false],
            ['Good evening', '/hello/', false],
            // Empty test
            ['', '/hello/', false],
            [null, '/hello/', false],
            [false, '/hello/', false],
        ];
    }

    /**
     * Tests Valid::range()
     *
     * Tests if a number is within a range.
     *
     * @dataProvider providerRegex
     *
     * @param string $value    Value to test against
     * @param string $regex    Valid pcre regular expression
     * @param bool   $expected Does the value match the expression?
     */
    public function testRegex($value, $regex, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::regex($value, $regex)
        );
    }

    /**
     * DataProvider for the valid::range() test
     */
    public function providerRange()
    {
        return [
            [1, 0, 2, null, true],
            [-1, -5, 0, null, true],
            [-1, 0, 1, null, false],
            [1, 0, 0, null, false],
            [2147483647, 0, 200000000000000, null, true],
            [-2147483647, -2147483655, 2147483645, null, true],
            // #4043
            [2, 0, 10, 2, true],
            [3, 0, 10, 2, false],
            // #4672
            [0, 0, 10, null, true],
            [10, 0, 10, null, true],
            [-10, -10, 10, null, true],
            [-10, -1, 1, null, false],
            [0, 0, 10, 2, true], // with $step
            [10, 0, 10, 2, true],
            [10, 0, 10, 3, false], // max outside $step
            [12, 0, 12, 3, true],
            // Empty test
            ['', 5, 10, null, false],
            [null, 5, 10, null, false],
            [false, 5, 10, null, false],
        ];
    }

    /**
     * Tests Valid::range()
     *
     * Tests if a number is within a range.
     *
     * @dataProvider providerRange
     *
     * @param integer $number   Number to test
     * @param integer $min      Lower bound
     * @param integer $max      Upper bound
     * @param boolean $expected Is Number within the bounds of $min && $max
     */
    public function testRange($number, $min, $max, $step, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::range($number, $min, $max, $step)
        );
    }

    /**
     * Provides test data for testUrl()
     *
     * @return array
     */
    public function providerUrl()
    {
        $data = [
            ['http://google.com', true],
            ['http://google.com/', true],
            ['http://google.com/?q=abc', true],
            ['http://google.com/#hash', true],
            ['http://localhost', true],
            ['http://hello-world.pl', true],
            ['http://hello--world.pl', true],
            ['http://h.e.l.l.0.pl', true],
            ['http://server.tld/get/info', true],
            ['http://127.0.0.1', true],
            ['http://127.0.0.1:80', true],
            ['http://user@127.0.0.1', true],
            ['http://user:pass@127.0.0.1', true],
            ['ftp://my.server.com', true],
            ['rss+xml://rss.example.com', true],

            ['http://google.2com', false],
            ['http://google.com?q=abc', false],
            ['http://google.com#hash', false],
            ['http://hello-.pl', false],
            ['http://hel.-lo.world.pl', false],
            ['http://ww£.google.com', false],
            ['http://127.0.0.1334', false],
            ['http://127.0.0.1.1', false],
            ['http://user:@127.0.0.1', false],
            ["http://finalnewline.com\n", false],
            // Empty test
            ['', false],
            [null, false],
            [false, false],
        ];

        $data[] = ['http://' . str_repeat('123456789.', 25) . 'com/',
                   true]; // 253 chars
        $data[] = ['http://' . str_repeat('123456789.', 25) . 'info/',
                   false]; // 254 chars

        return $data;
    }

    /**
     * Tests Valid::url()
     *
     * @dataProvider providerUrl
     *
     * @param string  $url      The url to test
     * @param boolean $expected Is it valid?
     */
    public function testUrl($url, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::url($url)
        );
    }

    /**
     * DataProvider for the valid::matches() test
     */
    public function providerMatches()
    {
        return [
            [['a' => 'hello', 'b' => 'hello'], 'a', 'b', true],
            [['a' => 'hello', 'b' => 'hello '], 'a', 'b', false],
            [['a' => '1', 'b' => 1], 'a', 'b', false],
            // Empty test
            [['a' => '', 'b' => 'hello'], 'a', 'b', false],
            [['a' => null, 'b' => 'hello'], 'a', 'b', false],
            [['a' => false, 'b' => 'hello'], 'a', 'b', false],
        ];
    }

    /**
     * Tests Valid::matches()
     *
     * Tests if a field matches another from an array of data
     *
     * @dataProvider providerMatches
     *
     * @param array   $data     Array of fields
     * @param integer $field    First field name
     * @param integer $match    Field name that must match $field in $data
     * @param boolean $expected Do the two fields match?
     */
    public function testMatches($data, $field, $match, $expected)
    {
        $this->assertSame(
            $expected,
            Valid::matches($data, $field, $match)
        );
    }
}
