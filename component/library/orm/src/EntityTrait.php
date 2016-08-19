<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM;

use ArrayIterator;
use Doctrine\Common\Collections\Collection;
use WellCart\Utility\Str;
use Zend\Hydrator\ClassMethods;

trait EntityTrait
{
    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Gets a native PHP array representation of the object.
     *
     * @return array
     */
    public function toArray()
    {
        $hydrator = new ClassMethods(true);
        $data = $hydrator->extract($this);

        unset(
            $data['input_filter_specification'],
            $data['array_copy'],
            $data['iterator']
        );

        $arr = [];
        foreach ($data as $key => $value) {
            $arr[$key] = $value;
        }
        return $arr;
    }

    /**
     * Turn object into JSON string
     *
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->toJson();
        } catch (\Throwable $e) {
            $msg = get_class($e) . ': ' . $e->getMessage();
            trigger_error($msg, E_USER_ERROR);
            return '';
        }
    }

    /**
     * Convert the entity instance to JSON.
     *
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        $data = $this->toArray();
        $data = array_filter(
            $data, function ($var) {
            return ((!$var instanceof AbstractEntity)
                && (!$var instanceof Collection));
        }
        );
        return json_encode($data, $options);
    }

    /**
     * Get a data by key
     *
     * @param string The key data to retrieve
     *
     * @access public
     */
    public function &__get($key)
    {
        $key = Str::underscored2camel($key);
        return $this->{$key};
    }

    /**
     * Assigns a value to the specified data
     *
     * @param string The data key to assign the value to
     * @param mixed  The value to set
     *
     * @access public
     */
    public function __set($key, $value)
    {
        $key = Str::underscored2camel($key);
        $this->{$key} = $value;
    }

    /**
     * Whether or not an data exists by key
     *
     * @param string An data key to check for
     *
     * @access public
     * @return boolean
     */
    public function __isset($key)
    {
        $key = Str::underscored2camel($key);
        return isset($this->{$key});
    }

    /**
     * Unsets an data by key
     *
     * @param string The key to unset
     *
     * @access public
     */
    public function __unset($key)
    {
        $key = Str::underscored2camel($key);
        unset($this->{$key});
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     *
     * @access public
     */
    public function offsetSet($offset, $value)
    {
        $offset = Str::underscored2camel($offset);
        $this->{$offset} = $value;
    }

    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     *
     * @access public
     */
    public function offsetUnset($offset)
    {
        $offset = Str::underscored2camel($offset);
        if ($this->offsetExists($offset)) {
            unset($this->{$offset});
        }
    }

    /**
     * Whether or not an offset exists
     *
     * @param string An offset to check for
     *
     * @access public
     * @return boolean
     */
    public function offsetExists($offset)
    {
        $offset = Str::underscored2camel($offset);
        return isset($this->{$offset});
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     *
     * @access public
     * @return mixed
     */
    public function offsetGet($offset)
    {
        $offset = Str::underscored2camel($offset);
        return $this->offsetExists($offset) ? $this->{$offset} : null;
    }

    /**
     * Returns an array iterator object.
     *
     * @return  \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this);
    }
}