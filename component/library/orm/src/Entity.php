<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\ORM;

use ArrayAccess;
use WellCart\Stdlib\ArrayableInterface;
use WellCart\Stdlib\JsonableInterface;
use Zend\Stdlib\JsonSerializable;

interface Entity
    extends
    JsonSerializable,
    ArrayableInterface,
    JsonableInterface,
    ArrayAccess

{

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return AbstractEntity
     */
    public function setId($id);

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize();

    /**
     * Gets a native PHP array representation of the object.
     *
     * @return array
     */
    public function toArray();

    /**
     * Turn object into JSON string
     *
     * @return string
     */
    public function __toString();

    /**
     * Convert the entity instance to JSON.
     *
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 0);

    /**
     * Get a data by key
     *
     * @param string The key data to retrieve
     *
     * @access public
     */
    public function &__get($key);

    /**
     * Assigns a value to the specified data
     *
     * @param string The data key to assign the value to
     * @param mixed  The value to set
     *
     * @access public
     */
    public function __set($key, $value);

    /**
     * Whether or not an data exists by key
     *
     * @param string An data key to check for
     *
     * @access public
     * @return boolean
     */
    public function __isset($key);

    /**
     * Unsets an data by key
     *
     * @param string The key to unset
     *
     * @access public
     */
    public function __unset($key);

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     *
     * @access public
     */
    public function offsetSet($offset, $value);

    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     *
     * @access public
     */
    public function offsetUnset($offset);

    /**
     * Whether or not an offset exists
     *
     * @param string An offset to check for
     *
     * @access public
     * @return boolean
     */
    public function offsetExists($offset);

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     *
     * @access public
     * @return mixed
     */
    public function offsetGet($offset);
}