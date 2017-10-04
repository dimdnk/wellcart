<?php

namespace WellCart\Ui\Layout\Handle;

/**
 * @package WellCart\Ui\Layout
 
 */
interface HandleInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getPriority();

    /**
     * @return string
     */
    public function __toString();
}
