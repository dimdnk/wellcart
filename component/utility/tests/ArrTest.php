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
 * Array helper test.
 *
 */
class ArrTest extends TestCase
{
    public static function mergeArrays()
    {
        return array(
            'merge-integer-and-string-keys'
            => array(
                array(
                    'foo',
                    3     => 'bar',
                    'baz' => 'baz',
                    4     => array(
                        'a',
                        1 => 'b',
                        'c',
                    ),
                ),
                array(
                    'baz',
                    4 => array(
                        'd' => 'd',
                    ),
                ),
                false,
                array(
                    0     => 'foo',
                    3     => 'bar',
                    'baz' => 'baz',
                    4     => array(
                        'a',
                        1 => 'b',
                        'c',
                    ),
                    5     => 'baz',
                    6     => array(
                        'd' => 'd',
                    ),
                )
            ),
            'merge-integer-and-string-keys-preserve-numeric'
            =>
                array(
                    array(
                        'foo',
                        3     => 'bar',
                        'baz' => 'baz',
                        4     => array(
                            'a',
                            1 => 'b',
                            'c',
                        ),
                    ),
                    array(
                        'baz',
                        4 => array(
                            'd' => 'd',
                        ),
                    ),
                    true,
                    array(
                        0     => 'baz',
                        3     => 'bar',
                        'baz' => 'baz',
                        4     => array(
                            'a',
                            1   => 'b',
                            'c',
                            'd' => 'd',
                        ),
                    )
                ),
            'merge-arrays-recursively'
            => array(
                array(
                    'foo' => array(
                        'baz'
                    )
                ),
                array(
                    'foo' => array(
                        'baz'
                    )
                ),
                false,
                array(
                    'foo' => array(
                        0 => 'baz',
                        1 => 'baz'
                    )
                )
            ),
            'replace-string-keys'
            => array(
                array(
                    'foo' => 'bar',
                    'bar' => array()
                ),
                array(
                    'foo' => 'baz',
                    'bar' => 'bat'
                ),
                false,
                array(
                    'foo' => 'baz',
                    'bar' => 'bat'
                )
            ),
            'merge-with-null'
            => array(
                array(
                    'foo' => null,
                    null  => 'rod',
                    'cat' => 'bar',
                    'god' => 'rad'
                ),
                array(
                    'foo' => 'baz',
                    null  => 'zad',
                    'god' => null
                ),
                false,
                array(
                    'foo' => 'baz',
                    null  => 'zad',
                    'cat' => 'bar',
                    'god' => null
                )
            ),
        );
    }

    public function testSet()
    {
        $arr = [];
        Arr::set($arr, 'foo', '123');
        Arr::set($arr, 'bar.baz', '456');
        Arr::set($arr, 'bar.bax.0', '789');
        $this->assertEquals(
            ['foo' => '123', 'bar' => ['baz' => '456', 'bax' => ['789']]], $arr
        );
    }

    public function testHas()
    {
        $arr = ['foo' => '123', 'bar' => ['baz' => '456', 'bax' => ['789']]];
        $this->assertTrue(Arr::has($arr, 'foo'));
        $this->assertTrue(Arr::has($arr, 'bar.baz'));
        $this->assertTrue(Arr::has($arr, 'bar.bax.0'));
        $this->assertFalse(Arr::has($arr, 'bar.bax.1'));
    }

    public function testGet()
    {
        $arr = ['foo' => '123', 'bar' => ['baz' => '456', 'bax' => ['789']]];
        $this->assertEquals('123', Arr::get($arr, 'foo'));
        $this->assertEquals('456', Arr::get($arr, 'bar.baz'));
        $this->assertEquals('789', Arr::get($arr, 'bar.bax.0'));
        $this->assertEquals('abc', Arr::get($arr, 'bar.bax.1', 'abc'));
    }

    public function testDelete()
    {
        $arr = ['foo' => '123', 'bar' => ['baz' => '456', 'bax' => ['789']]];
        $this->assertTrue(Arr::delete($arr, 'foo'));
        $this->assertTrue(Arr::delete($arr, 'bar.baz'));
        $this->assertTrue(Arr::delete($arr, 'bar.bax.0'));
        $this->assertFalse(Arr::delete($arr, 'test.undefined'));
        $this->assertEquals(['bar' => ['bax' => []]], $arr);
    }

    public function testRandom()
    {
        $arr = ['foo', 'bar', 'baz'];
        $this->assertTrue(in_array(Arr::random($arr), $arr));
    }

    public function testIsAssoc()
    {
        $this->assertTrue(Arr::isAssoc(['foo' => 0, 'bar' => 1]));
        $this->assertFalse(Arr::isAssoc([0 => 'foo', 1 => 'bar']));
        $this->assertFalse(Arr::isAssoc(['foo' => 0, 1 => 'bar']));
    }

    public function testPluck()
    {
        $arr = [['foo' => 'bar'], ['foo' => 'baz']];
        $this->assertEquals(['bar', 'baz'], Arr::pluck($arr, 'foo'));

        $obj1 = new \StdClass;
        $obj1->foo = 'bar';
        $obj2 = new \StdClass;
        $obj2->foo = 'baz';
        $arr = [$obj1, $obj2];
        $this->assertEquals(['bar', 'baz'], Arr::pluck($arr, 'foo'));
    }

    public function testArrayFetch()
    {
        $data = array(
            'post-1' => array(
                'comments' => array(
                    'tags' => array(
                        '#foo', '#bar',
                    ),
                ),
            ),
            'post-2' => array(
                'comments' => array(
                    'tags' => array(
                        '#baz',
                    ),
                ),
            ),
        );
        $this->assertEquals(
            array(
                0 => array(
                    'tags' => array(
                        '#foo', '#bar',
                    ),
                ),
                1 => array(
                    'tags' => array(
                        '#baz',
                    ),
                ),
            ), Arr::fetch($data, 'comments')
        );
        $this->assertEquals(
            array(array('#foo', '#bar'), array('#baz')),
            Arr::fetch($data, 'comments.tags')
        );
    }

    /**
     * @dataProvider mergeArrays
     */
    public function testMerge($a, $b, $preserveNumericKeys, $expected)
    {
        $this->assertEquals(
            $expected, Arr::merge($a, $b, $preserveNumericKeys)
        );
    }

    public function testBuild()
    {
        $this->assertEquals(
            array('foo' => 'bar'), Arr::build(
            array('foo' => 'bar'), function ($key, $value) {
            return array($key, $value);
        }
        )
        );
    }

    public function testArrayExcept()
    {
        $array = array('name' => 'taylor', 'age' => 26);
        $this->assertEquals(
            array('age' => 26), Arr::except($array, array('name'))
        );
    }

    public function testArrayOnly()
    {
        $array = array('name' => 'taylor', 'age' => 26);
        $this->assertEquals(
            array('name' => 'taylor'), Arr::only($array, array('name'))
        );
        $this->assertSame(array(), Arr::only($array, array('nonExistingKey')));
    }

    public function testDivide()
    {
        $array = array('name' => 'taylor');
        list($keys, $values) = Arr::divide($array);
        $this->assertEquals(array('name'), $keys);
        $this->assertEquals(array('taylor'), $values);
    }

    public function testFirst()
    {
        $array = array('name' => 'taylor', 'otherDeveloper' => 'dayle');
        $this->assertEquals(
            'dayle', Arr::first(
            $array, function ($key, $value) {
            return $value == 'dayle';
        }
        )
        );
        $this->assertEquals(
            'default', Arr::first(
            $array, function ($key, $value) {
            return $value == 'undefined';
        }, 'default'
        )
        );
    }

    public function testLast()
    {
        $array = array('name' => 'taylor', 'otherDeveloper' => 'dayle');
        $this->assertEquals(
            'dayle', Arr::last(
            $array, function ($key, $value) {
            return $value == 'dayle';
        }
        )
        );
        $this->assertEquals(
            'default', Arr::last(
            $array, function ($key, $value) {
            return $value == 'undefined';
        }, 'default'
        )
        );
    }

    public function testFlatten()
    {
        $this->assertEquals(
            array('#foo', '#bar', '#baz'),
            Arr::flatten(array(array('#foo', '#bar'), array('#baz')))
        );
    }

    public function testFlattenSeparated()
    {
        $arr = ['x' => ['y' => ['z' => 42]]];
        $this->assertEquals(['x.y.z' => 42], Arr::flattenSeparated($arr));
        $this->assertEquals(['x*y*z' => 42], Arr::flattenSeparated($arr, '*'));
    }

    public function testWhere()
    {
        $array = array(100, '200', 300, '400', 500);
        $array = Arr::where(
            $array, function ($key, $value) {
            return is_string($value);
        }
        );
        $this->assertEquals(Array(1 => 200, 3 => 400), $array);
    }


}