<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use PHPUnit\Framework\TestCase;

/**
 * Boolean helper test.
 *
 */
class BooleansTest extends TestCase
{
    /**
     * @var Booleans
     */
    protected $object;

    public function testConstructor()
    {
        $object = new Booleans(array('yep'), array('nope'));
        $this->assertTrue($object->toBoolean('yep'));
        $this->assertFalse($object->toBoolean('nope'));
    }

    /**
     * @param mixed $input
     * @param bool  $expected
     *
     * @dataProvider toBooleanDataProvider
     */
    public function testToBoolean($input, $expected)
    {
        $actual = $this->object->toBoolean($input);
        $this->assertSame($expected, $actual);
    }

    public function toBooleanDataProvider()
    {
        return array(
            'boolean "true"'         => array(true, true),
            'boolean "false"'        => array(false, false),
            'boolean string "true"'  => array('true', true),
            'boolean string "false"' => array('false', false),
            'boolean numeric "1"'    => array(1, true),
            'boolean numeric "0"'    => array(0, false),
            'boolean string "1"'     => array('1', true),
            'boolean string "0"'     => array('0', false)
        );
    }

    /**
     * @param mixed $input
     *
     * @dataProvider             toBooleanExceptionDataProvider
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Boolean value is expected
     */
    public function testToBooleanException($input)
    {
        $this->object->toBoolean($input);
    }

    public function toBooleanExceptionDataProvider()
    {
        return array(
            'boolean string "on"'    => array('on'),
            'boolean string "off"'   => array('off'),
            'boolean string "yes"'   => array('yes'),
            'boolean string "no"'    => array('no'),
            'boolean string "TRUE"'  => array('TRUE'),
            'boolean string "FALSE"' => array('FALSE'),
            'empty string'           => array(''),
            'null'                   => array(null)
        );
    }

    protected function setUp()
    {
        $this->object = new Booleans();
    }

}