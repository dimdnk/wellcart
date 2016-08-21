<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */



namespace WellCart\Utility;

use ArrayAccess;
use ArrayIterator;
use Closure;
use Countable;
use IteratorAggregate;
use OutOfBoundsException;

/**
 * Collection.
 */
class Collection
    implements ArrayAccess, Countable, IteratorAggregate
{
    /**
     * Collection items.
     *
     * @var array
     */
    protected $items = [];

    protected $position = 0;

    /**
     * Constructor.
     *
     * @param   array $items Collection items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Returns all the items in the collection.
     *
     * @return  array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Checks whether or not an offset exists.
     *
     * @param   mixed $offset The offset to check for
     *
     * @return  boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * Unsets an offset.
     *
     * @param   mixed $offset The offset to unset
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * Returns the number of items in the collection.
     *
     * @return  int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Returns an array iterator object.
     *
     * @return  \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Returns TRUE if the collection is empty and FALSE if not.
     *
     * @return  boolean
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * Prepends the passed item to the front of the collection
     * and returns the new number of elements in the collection.
     *
     * @param   mixed $item Collection item
     *
     * @return  int
     */
    public function unshift($item)
    {
        return array_unshift($this->items, $item);
    }

    /**
     * Shifts the first value of the collection off and returns it,
     * shortening the collection by one element.
     *
     * @return  mixed
     */
    public function shift()
    {
        return array_shift($this->items);
    }

    /**
     * Pushes the passed variable onto the end of the collection
     * and returns the new number of elements in the collection.
     *
     * @param   mixed $item Collection item
     *
     * @return  int
     */
    public function push($item)
    {
        return array_push($this->items, $item);
    }

    /**
     * Pops and returns the last value of the collection,
     * shortening the collection by one element.
     *
     * @return  mixed
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * Sorts the collection using the specified comparator closure
     * and returns TRUE on success and FALSE on failure.
     *
     * @param   \Closure $comparator Comparator closure
     *
     * @return  boolean
     */
    public function sort(Closure $comparator)
    {
        return uasort($this->items, $comparator);
    }

    /**
     * Chunks the collection into a collection containing $size sized collections.
     *
     * @param   int $size Chunk size
     *
     * @return  Collection
     */
    public function chunk($size)
    {
        $collections = [];

        foreach (array_chunk($this->items, $size) as $chunk) {
            $collections[] = new static($chunk);
        }

        return new static($collections);
    }

    /**
     * Shuffles the items in the collection and returns
     * TRUE on success and FALSE on failure.
     *
     * @return  boolean
     */
    public function shuffle()
    {
        return shuffle($this->items);
    }

    public function get($offset)
    {
        return $this->offsetGet($offset);
    }

    /**
     * Returns the value at the specified offset.
     *
     * @param   mixed $offset The offset to retrieve
     *
     * @return  mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    public function set($offset, $value)
    {
        return $this->offsetSet($offset, $value);
    }

    /**
     * Assigns a value to the specified offset.
     *
     * @param   mixed $offset The offset to assign the value to
     * @param   mixed $value  The value to set
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function seek($position)
    {
        if (!isset($this->items[$position])) {
            throw new OutOfBoundsException("invalid seek position ($position)");
        }
        $this->position = $position;
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->items[$this->position]);
    }

    public function first()
    {
        $this->rewind();
        return $this->current();
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->items[$this->position];
    }

    public function last()
    {
        $this->position = count($this->items) - 1;
        return end($this->items);
    }

}