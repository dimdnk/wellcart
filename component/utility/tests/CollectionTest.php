<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testGetItems()
    {
        $collection = new Collection();
        $this->assertEquals([], $collection->getItems());
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $collection->getItems());
    }

    public function testOffsetExists()
    {
        $collection = new Collection();
        $this->assertFalse(isset($collection[0]));
        $collection = new Collection([1, 2, 3]);
        $this->assertTrue(isset($collection[0]));
    }

    public function testOffsetGet()
    {
        $collection = new Collection();
        $this->assertNull($collection[0]);

        $collection = new Collection([1, 2, 3]);
        $this->assertEquals(1, $collection[0]);
    }

    public function testOffsetSet()
    {
        $collection = new Collection();
        $collection[4] = 'foobar';

        $this->assertTrue(isset($collection[4]));
        $this->assertEquals('foobar', $collection[4]);

        $collection->offsetSet(null, 'buzz');
        $this->assertCount(2, $collection);
    }

    public function testOffsetUnset()
    {
        $collection = new Collection([1, 2, 3]);

        unset($collection[1]);

        $this->assertFalse(isset($collection[1]));
    }

    public function testCount()
    {
        $collection = new Collection();

        $this->assertEquals(0, count($collection));

        $this->assertEquals(0, $collection->count());

        $collection = new Collection([1, 2, 3]);

        $this->assertEquals(3, count($collection));

        $this->assertEquals(3, $collection->count());
    }

    public function testIteration()
    {
        $string = '';

        foreach (new Collection([1, 2, 3]) as $item) {
            $string .= $item;
        }

        $this->assertEquals('123', $string);
    }

    public function testIsEmpty()
    {
        $collection = new Collection();

        $this->assertTrue($collection->isEmpty());

        $collection = new Collection([1, 2, 3]);

        $this->assertFalse($collection->isEmpty());
    }

    public function testUnshift()
    {
        $collection = new Collection([1, 2, 3]);

        $count = $collection->unshift(10);

        $this->assertEquals(4, $count);

        $this->assertEquals([10, 1, 2, 3], $collection->getItems());
    }

    public function testShift()
    {
        $collection = new Collection([1, 2, 3]);

        $item = $collection->shift();

        $this->assertEquals(1, $item);

        $this->assertEquals([2, 3], $collection->getItems());
    }

    public function testPush()
    {
        $collection = new Collection([1, 2, 3]);

        $count = $collection->push(10);

        $this->assertEquals(4, $count);

        $this->assertEquals([1, 2, 3, 10], $collection->getItems());
    }

    public function testPop()
    {
        $collection = new Collection([1, 2, 3]);

        $item = $collection->pop();

        $this->assertEquals(3, $item);

        $this->assertEquals([1, 2], $collection->getItems());
    }

    public function testChunk()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);

        $collection = $collection->chunk(2);

        $this->assertEquals(3, count($collection));

        $this->assertEquals([1, 2], $collection[0]->getItems());

        $this->assertEquals([3, 4], $collection[1]->getItems());

        $this->assertEquals([5, 6], $collection[2]->getItems());
    }

    public function testShuffle()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);
        $collection->shuffle();
        $this->assertEquals(6, $collection->count());
    }

    public function testSort()
    {
        $collection = new Collection(['a' => 0.9, 'b' => 0.7, 'c' => 0.8]);
        $callback = function ($a, $b) {
            $d = $a = $b;
            return $d < 0 ? -1 : ($d > 0 ? 1 : 0);
        };

        $collection->sort($callback);
        $this->assertEquals(
            [
                'a' => 0.90000000000000002,
                'b' => 0.69999999999999996,
                'c' => 0.80000000000000004,
            ]
            ,
            $collection->getItems()
        );
    }
}