<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use WellCart\Test\TestCase;

/**
 * Array helper test.
 *
 */
class ArrTest extends TestCase
{

    public static function mergeArrays()
    {
        return [
            'merge-integer-and-string-keys'
            => [
                [
                    'foo',
                    3     => 'bar',
                    'baz' => 'baz',
                    4     => [
                        'a',
                        1 => 'b',
                        'c',
                    ],
                ],
                [
                    'baz',
                    4 => [
                        'd' => 'd',
                    ],
                ],
                false,
                [
                    0     => 'foo',
                    3     => 'bar',
                    'baz' => 'baz',
                    4     => [
                        'a',
                        1 => 'b',
                        'c',
                    ],
                    5     => 'baz',
                    6     => [
                        'd' => 'd',
                    ],
                ],
            ],
            'merge-integer-and-string-keys-preserve-numeric'
            =>
                [
                    [
                        'foo',
                        3     => 'bar',
                        'baz' => 'baz',
                        4     => [
                            'a',
                            1 => 'b',
                            'c',
                        ],
                    ],
                    [
                        'baz',
                        4 => [
                            'd' => 'd',
                        ],
                    ],
                    true,
                    [
                        0     => 'baz',
                        3     => 'bar',
                        'baz' => 'baz',
                        4     => [
                            'a',
                            1   => 'b',
                            'c',
                            'd' => 'd',
                        ],
                    ],
                ],
            'merge-arrays-recursively'
            => [
                [
                    'foo' => [
                        'baz',
                    ],
                ],
                [
                    'foo' => [
                        'baz',
                    ],
                ],
                false,
                [
                    'foo' => [
                        0 => 'baz',
                        1 => 'baz',
                    ],
                ],
            ],
            'replace-string-keys'
            => [
                [
                    'foo' => 'bar',
                    'bar' => [],
                ],
                [
                    'foo' => 'baz',
                    'bar' => 'bat',
                ],
                false,
                [
                    'foo' => 'baz',
                    'bar' => 'bat',
                ],
            ],
            'merge-with-null'
            => [
                [
                    'foo' => null,
                    null  => 'rod',
                    'cat' => 'bar',
                    'god' => 'rad',
                ],
                [
                    'foo' => 'baz',
                    null  => 'zad',
                    'god' => null,
                ],
                false,
                [
                    'foo' => 'baz',
                    null  => 'zad',
                    'cat' => 'bar',
                    'god' => null,
                ],
            ],
        ];
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
        $data = [
            'post-1' => [
                'comments' => [
                    'tags' => [
                        '#foo', '#bar',
                    ],
                ],
            ],
            'post-2' => [
                'comments' => [
                    'tags' => [
                        '#baz',
                    ],
                ],
            ],
        ];
        $this->assertEquals(
            [
                0 => [
                    'tags' => [
                        '#foo', '#bar',
                    ],
                ],
                1 => [
                    'tags' => [
                        '#baz',
                    ],
                ],
            ], Arr::fetch($data, 'comments')
        );
        $this->assertEquals(
            [['#foo', '#bar'], ['#baz']],
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
            ['foo' => 'bar'], Arr::build(
            ['foo' => 'bar'], function ($key, $value) {
            return [$key, $value];
        }
        )
        );
    }

    public function testArrayExcept()
    {
        $array = ['name' => 'taylor', 'age' => 26];
        $this->assertEquals(
            ['age' => 26], Arr::except($array, ['name'])
        );
    }

    public function testArrayOnly()
    {
        $array = ['name' => 'taylor', 'age' => 26];
        $this->assertEquals(
            ['name' => 'taylor'], Arr::only($array, ['name'])
        );
        $this->assertSame([], Arr::only($array, ['nonExistingKey']));
    }

    public function testDivide()
    {
        $array = ['name' => 'taylor'];
        list($keys, $values) = Arr::divide($array);
        $this->assertEquals(['name'], $keys);
        $this->assertEquals(['taylor'], $values);
    }

    public function testFirst()
    {
        $array = ['name' => 'taylor', 'otherDeveloper' => 'dayle'];
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
        $array = ['name' => 'taylor', 'otherDeveloper' => 'dayle'];
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
            ['#foo', '#bar', '#baz'],
            Arr::flatten([['#foo', '#bar'], ['#baz']])
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
        $array = [100, '200', 300, '400', 500];
        $array = Arr::where(
            $array, function ($key, $value) {
            return is_string($value);
        }
        );
        $this->assertEquals([1 => 200, 3 => 400], $array);
    }


}