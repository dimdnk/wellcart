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
        return array(
            array('asdavafaiwnoabwiubafpowf', true),
            array('!aidhfawiodb', false),
            array('51535oniubawdawd78', false),
            array('!"£$(G$W£(HFW£F(HQ)"n', false),
            // UTF-8 tests
            array('あいうえお', true, true),
            array('¥', false, true),
            // Empty test
            array('', false, false),
            array(null, false, false),
            array(false, false, false),
        );
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
        return array(
            array('abcd1234', true),
            array('abcd', true),
            array('1234', true),
            array('abc123&^/-', false),
            // UTF-8 tests
            array('あいうえお', true, true),
            array('零一二三四五', true, true),
            array('あい四五£^£^', false, true),
            // Empty test
            array('', false, false),
            array(null, false, false),
            array(false, false, false),
        );
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
        return array(
            array('abcdef', true),
            array('12345', true),
            array('abcd1234', true),
            array('abcd1234-', true),
            array('abc123&^/-', false),
            // Empty test
            array('', false),
            array(null, false),
            array(false, false),
        );
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
        return array(
            array('now', true),
            array('10 September 2010', true),
            array('+1 day', true),
            array('+1 week', true),
            array('+1 week 2 days 4 hours 2 seconds', true),
            array('next Thursday', true),
            array('last Monday', true),

            array('blarg', false),
            array('in the year 2000', false),
            array('324824', false),
            // Empty test
            array('', false),
            array(null, false),
            array(false, false),
        );
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
        return array(
            // Empty test
            array('', 2, null, false),
            array(null, 2, null, false),
            array(false, 2, null, false),
            array('45.1664', 3, null, false),
            array('45.1664', 4, null, true),
            array('45.1664', 4, 2, true),
            array('-45.1664', 4, null, true),
            array('+45.1664', 4, null, true),
            array('-45.1664', 3, null, false),
        );
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
        return array(
            array('12345', true),
            array('10.5', false),
            array('abcde', false),
            array('abcd1234', false),
            array('-5', false),
            array(-5, false),
            // Empty test
            array('', false),
            array(null, false),
            array(false, false),
        );
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
        return array(
            array('#000000', true),
            array('#GGGGGG', false),
            array('#AbCdEf', true),
            array('#000', true),
            array('#abc', true),
            array('#DEF', true),
            array('000000', true),
            array('GGGGGG', false),
            array('AbCdEf', true),
            array('000', true),
            array('DEF', true),
            // Empty test
            array('', false),
            array(null, false),
            array(false, false),
        );
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
        return array(
            array('4222222222222', true),
            array('4012888888881881', true),
            array('5105105105105100', true),
            array('6011111111111117', true),
            array('60111111111111.7', false),
            array('6011111111111117X', false),
            array('6011111111111117 ', false),
            array('WORD ', false),
            // Empty test
            array('', false),
            array(null, false),
            array(false, false),
        );
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
        return array(
            array('foo', true, false),
            array('foo', false, false),

            array('foo@bar', true, true),
            // RFC is less strict than the normal regex, presumably to allow
            //  admin@localhost, therefore we IGNORE IT!!!
            array('foo@bar', false, false),
            array('foo@bar.com', false, true),
            array('foo@barcom:80', false, false),
            array('foo@bar.sub.com', false, true),
            array('foo+asd@bar.sub.com', false, true),
            array('foo.asd@bar.sub.com', false, true),
            // Empty test
            array('', true, false),
            array(null, true, false),
            array(false, true, false),
        );
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
        return array(
            array('google.com', true),
            // Don't anybody dare register this...
            array('DAWOMAWIDAIWNDAIWNHDAWIHDAIWHDAIWOHDAIOHDAIWHD.com', false),
            // Empty test
            array('', false),
            array(null, false),
            array(false, false),
        );
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
        return array(
            array('somestring', 10, true),
            array('somestring', 11, false),
            array('anotherstring', 13, true),
            // Empty test
            array('', 10, false),
            array(null, 10, false),
            array(false, 10, false),
            // Test array of allowed lengths
            array('somestring', array(1, 3, 5, 7, 9, 10), true),
            array('somestring', array(1, 3, 5, 7, 9), false),
        );
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
        return array(
            array('foo', 'foo', true),
            array('1', '1', true),
            array(1, '1', false),
            array('011', 011, false),
            // Empty test
            array('', 123, false),
            array(null, 123, false),
            array(false, 123, false),
        );
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
        return array(
            array('75.125.175.50', false, true),
            array('256.257.258.259', false, false),
            array('255.255.255.255', false, false),
            array('192.168.0.1', false, false),
            // Empty test
            array('', true, false),
            array(null, true, false),
            array(false, true, false),
        );
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
        return array(
            // Border line
            array('some', 4, true),
            // Exceeds
            array('UPPERCASEDEMO', 2, false),
            // Under
            array('SnakeCaseDemo', 13, true),
            // Empty test
            array('', -10, false),
            array(null, -10, false),
            array(false, -10, false),
        );
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
        return array(
            array('This is obviously long enough', 10, true),
            array('This is not', 101, false),
            array('This is on the borderline', 25, true),
            // Empty test
            array('', 10, false),
            array(null, 10, false),
            array(false, 10, false),
        );
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

        return array(
            array(array(), false),
            array(null, false),
            array('', false),
            array($ao, false),
            array($ao1, true),
            array(array(null), true),
            array(0, true),
            array('0', true),
            array('Something', true),
        );
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
        return array(
            array(12345, true),
            array(123.45, true),
            array('12345', true),
            array('10.5', true),
            array('-10.5', true),
            array('10.5a', false),
            // @issue 3240
            array(.4, true),
            array(-.4, true),
            array(4., true),
            array(-4., true),
            array('.5', true),
            array('-.5', true),
            array('5.', true),
            array('-5.', true),
            array('.', false),
            array('1.2.3', false),
            // Empty test
            array('', false),
            array(null, false),
            array(false, false),
        );
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
        return array(
            array('0163634840', null, true),
            array('+27173634840', null, true),
            array('123578', null, false),
            // Some uk numbers
            array('01234456778', null, true),
            array('+0441234456778', null, false),
            // Google UK case you're interested
            array('+44 20-7031-3000', array(12), true),
            // BT Corporate
            array('020 7356 5000', null, true),
            // Empty test
            array('', null, false),
            array(null, null, false),
            array(false, null, false),
        );
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
        return array(
            array('hello world', '/[a-zA-Z\s]++/', true),
            array('123456789', '/[0-9]++/', true),
            array('£$%£%', '/[abc]/', false),
            array('Good evening', '/hello/', false),
            // Empty test
            array('', '/hello/', false),
            array(null, '/hello/', false),
            array(false, '/hello/', false),
        );
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
        return array(
            array(1, 0, 2, null, true),
            array(-1, -5, 0, null, true),
            array(-1, 0, 1, null, false),
            array(1, 0, 0, null, false),
            array(2147483647, 0, 200000000000000, null, true),
            array(-2147483647, -2147483655, 2147483645, null, true),
            // #4043
            array(2, 0, 10, 2, true),
            array(3, 0, 10, 2, false),
            // #4672
            array(0, 0, 10, null, true),
            array(10, 0, 10, null, true),
            array(-10, -10, 10, null, true),
            array(-10, -1, 1, null, false),
            array(0, 0, 10, 2, true), // with $step
            array(10, 0, 10, 2, true),
            array(10, 0, 10, 3, false), // max outside $step
            array(12, 0, 12, 3, true),
            // Empty test
            array('', 5, 10, null, false),
            array(null, 5, 10, null, false),
            array(false, 5, 10, null, false),
        );
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
        $data = array(
            array('http://google.com', true),
            array('http://google.com/', true),
            array('http://google.com/?q=abc', true),
            array('http://google.com/#hash', true),
            array('http://localhost', true),
            array('http://hello-world.pl', true),
            array('http://hello--world.pl', true),
            array('http://h.e.l.l.0.pl', true),
            array('http://server.tld/get/info', true),
            array('http://127.0.0.1', true),
            array('http://127.0.0.1:80', true),
            array('http://user@127.0.0.1', true),
            array('http://user:pass@127.0.0.1', true),
            array('ftp://my.server.com', true),
            array('rss+xml://rss.example.com', true),

            array('http://google.2com', false),
            array('http://google.com?q=abc', false),
            array('http://google.com#hash', false),
            array('http://hello-.pl', false),
            array('http://hel.-lo.world.pl', false),
            array('http://ww£.google.com', false),
            array('http://127.0.0.1334', false),
            array('http://127.0.0.1.1', false),
            array('http://user:@127.0.0.1', false),
            array("http://finalnewline.com\n", false),
            // Empty test
            array('', false),
            array(null, false),
            array(false, false),
        );

        $data[] = array('http://' . str_repeat('123456789.', 25) . 'com/',
                        true); // 253 chars
        $data[] = array('http://' . str_repeat('123456789.', 25) . 'info/',
                        false); // 254 chars

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
        return array(
            array(array('a' => 'hello', 'b' => 'hello'), 'a', 'b', true),
            array(array('a' => 'hello', 'b' => 'hello '), 'a', 'b', false),
            array(array('a' => '1', 'b' => 1), 'a', 'b', false),
            // Empty test
            array(array('a' => '', 'b' => 'hello'), 'a', 'b', false),
            array(array('a' => null, 'b' => 'hello'), 'a', 'b', false),
            array(array('a' => false, 'b' => 'hello'), 'a', 'b', false),
        );
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
