<?php
namespace WellCart\Ui\Layout\EventListener;

use WellCart\Ui\Layout\Layout\LayoutInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ModelInterface;
use Zend\Console\Console;
/**
 * @package WellCart\Ui\Layout 
 */
class LoadLayoutListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     *
     * @var LayoutInterface
     */
    protected $layout;

    /**
     *
     * @param LayoutInterface $layout
     */
    public function __construct(LayoutInterface $layout)
    {
        $this->layout = $layout;
    }

    /**
     *
     * @param EventManagerInterface $events
     * @param int $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        if (!Console::isConsole()) {
            $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH,  [$this, 'loadLayout'], $priority);
            $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'loadLayout'], $priority);
        }
    }

    /**
     * load layout if result ist not terminated
     *
     * @param MvcEvent $e
     */
    public function loadLayout(MvcEvent $e)
    {
        /* @var $result ModelInterface */
        $result = $e->getViewModel();
        if (!$result->terminate()) {
            $this->layout->load();
        }
    }
}
