<?php

namespace WellCart\Ui\Layout\Updater;

use WellCart\Ui\Layout\Handle\Handle;
use WellCart\Ui\Layout\Handle\HandleInterface;

/**
 * @package WellCart\Ui\Layout
 
 */
abstract class AbstractUpdater implements
    LayoutUpdaterInterface
{
    /**
     * Format:
     * (string) handle-name => (int) priority
     *
     * @var array
     */
    protected $handles = [
        'default' => -1
    ];

    /**
     *
     * @var string
     */
    protected $area = self::AREA_DEFAULT;

    /**
     * {@inheritdoc}
     */
    public function addHandle(HandleInterface $handle)
    {
        $this->handles[$handle->getName()] = $handle->getPriority();
        return $this;
    }

    /**
     *
     * @param array|HandleInterface[] $handles
     * @return AbstractUpdater
     */
    public function setHandles(array $handles)
    {
        $this->handles = [];
        foreach ($handles as $handle) {
            $this->addHandle($handle);
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeHandle($handleName)
    {
        if (isset($this->handles[$handleName])) {
            unset($this->handles[$handleName]);
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHandles($asObject = false)
    {
        asort($this->handles);
        if ($asObject) {
            $handles = [];
            foreach ($this->handles as $handle => $priority) {
                $handles[] = new Handle($handle, $priority);
            }
            return $handles;
        }
        return array_keys($this->handles);
    }

    /**
     * {@inheritDoc}
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     *
     * {@inheritDoc}
     */
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }
}
