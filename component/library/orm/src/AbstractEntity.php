<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\ORM;

use ArrayIterator;
use IteratorAggregate;

abstract class AbstractEntity
    implements
    Entity, IteratorAggregate
{

    use EntityTrait;

    /**
     * ID
     *
     * @var int
     */
    protected $id;

    /**
     * @return int|null
     */
    abstract public function getId();

    /**
     * @param int $id
     *
     * @return AbstractEntity
     */
    abstract public function setId($id);

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