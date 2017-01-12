<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Stdlib\Collection;

use Doctrine\Common\Collections\ArrayCollection as AbstractCollection;
use WellCart\Stdlib\ArrayableInterface;
use WellCart\Stdlib\JsonableInterface;
use Zend\Stdlib\JsonSerializable;

class ArrayCollection extends AbstractCollection implements
    JsonSerializable, ArrayableInterface, JsonableInterface
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
     * Convert the entity instance to JSON.
     *
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 1)
    {
        return json_encode($this->toArray(), $options);
    }
}