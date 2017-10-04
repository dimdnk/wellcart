<?php

namespace WellCart\Ui\Layout\Handle;

/**
 * @package WellCart\Ui\Layout
 
 */
final class Handle implements HandleInterface
{
    /**
     * handle name
     *
     * @var string
     */
    protected $name;

    /**
     * handle's priority
     *
     * @var int
     */
    protected $priority;

    /**
     *
     * @param string $name
     * @param int $priority
     */
    public function __construct($name, $priority)
    {
        $this->name     = $name;
        $this->priority = $priority;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getName();
    }
}
