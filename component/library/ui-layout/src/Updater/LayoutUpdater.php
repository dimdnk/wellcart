<?php

namespace WellCart\Ui\Layout\Updater;

use WellCart\Ui\Layout\Updater\Collector\CollectorInterface;
use WellCart\Ui\Layout\Updater\Collector\FilesystemCollector;
use WellCart\Ui\Layout\Updater\Event\UpdateEvent;
use Zend\Config\Config;
use Zend\Db\Sql\Update;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Stdlib\PriorityList;

/**
 * @package WellCart\Ui\Layout
 
 */
final class LayoutUpdater extends AbstractUpdater implements
    EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    /**
     *
     * @var Config
     */
    private $layoutStructure;

    /**
     * @var PriorityList|CollectorInterface[]
     */
    private $collectors;

    public function __construct()
    {
        $this->collectors = new PriorityList();
    }

    /**
     * @param string $name
     * @param CollectorInterface $collector
     * @param int $priority
     * @return $this
     */
    public function attachCollector($name, CollectorInterface $collector, $priority = 1)
    {
        $this->collectors->insert($name, $collector, $priority);
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function detachCollector($name)
    {
        $this->collectors->remove($name);
        return $this;
    }

    /**
     *
     * @return Config
     */
    public function getLayoutStructure()
    {
        if (null === $this->layoutStructure) {
            $this->layoutStructure = new Config([], true);

            $handles = $this->getHandles();
            $event = new UpdateEvent();
            $event->setLayoutStructure($this->layoutStructure);
            $event->setHandles($handles);
            $event->setArea($this->getArea());
            $event->setName(UpdateEvent::EVENT_COLLECT);
            $event->setTarget($this);

            $results = $this->getEventManager()->triggerEventUntil(
                function ($result) {
                    return ($result instanceof Config);
                },
                $event
            );

            if ($results->stopped()) {
                $this->layoutStructure = $results->last();
            } else {
                $this->fetchUpdates();
                $event->setName(UpdateEvent::EVENT_COLLECT_POST);
                $this->getEventManager()->triggerEvent($event);
            }

            $this->layoutStructure->setReadOnly();
        }
        return $this->layoutStructure;
    }

    private function fetchUpdates()
    {
        $handles = $this->getHandles();
        foreach ($handles as $handle) {
            $this->fetchHandle($handle);
        }
    }

    /**
     * @param string $handle
     */
    private function fetchHandle($handle)
    {
        foreach ($this->collectors->getIterator() as $collector) {
            $tempStructure = $collector->collect($handle, $this->getArea());
            if ($includes = $tempStructure->get(self::INSTRUCTION_INCLUDE)) {
                foreach ($includes as $include) {
                    $this->fetchHandle($include);
                }
            }
            $this->layoutStructure->merge($tempStructure);
        }
    }
}
