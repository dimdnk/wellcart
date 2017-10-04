<?php
namespace WellCart\Ui\Layout\Listener;

use WellCart\Ui\Layout\Listener\BodyClassListener;
use WellCart\Ui\Layout\View\Helper\BodyClass;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

/**
 * @package WellCart\Ui\Layout
 
 */
class BodyClassListener extends AbstractListenerAggregate
{
    /**
     *
     * @var BodyClass
     */
    protected $bodyClassHelper;
    
    /**
     *
     * @param BodyClass $bodyClassHelper
     */
    public function __construct(BodyClass $bodyClassHelper)
    {
        $this->bodyClassHelper = $bodyClassHelper;
    }

    /**
     *
     * @param EventManagerInterface $events
     * @param int $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'addBodyClass'], $priority);
    }
    
    /**
     *
     * @param MvcEvent $e
     * @return BodyClassListener
     */
    public function addBodyClass(MvcEvent $e)
    {
        $helper = $this->bodyClassHelper;
        $routeMatchName = $e->getRouteMatch()->getMatchedRouteName();
        $className = preg_replace('#[^a-z0-9-]+#i', '-', $routeMatchName);
        $helper(strtolower($className));
        return $this;
    }
}
