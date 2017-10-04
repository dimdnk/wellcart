<?php

namespace WellCart\Ui\Layout\Listener;

use WellCart\Ui\Layout\Block\BlockPoolInterface;
use WellCart\Ui\Layout\Layout\LayoutInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ModelInterface;

/**
 * Listener to prepare action result view model
 *
 * @package WellCart\Ui\Layout
 
 */
class PrepareActionViewModelListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @var LayoutInterface
     */
    private $blockPool;

    /**
     * PrepareActionViewModelListener constructor.
     * @param BlockPoolInterface $blockPool
     */
    public function __construct(BlockPoolInterface $blockPool)
    {
        $this->blockPool = $blockPool;
    }

    /**
     *
     * @param EventManagerInterface $events
     * @param int $priority
     */
    public function attach(EventManagerInterface $events, $priority = -300)
    {
        $this->listeners[] = $events->attach(
            [MvcEvent::EVENT_DISPATCH, MvcEvent::EVENT_DISPATCH_ERROR],
            [$this, 'prepareActionViewModel'],
            $priority
        );
    }

    /**
     *
     * @param MvcEvent $e
     */
    public function prepareActionViewModel(MvcEvent $e)
    {
        /* @var $result ModelInterface */
        $result = $e->getResult();
        if ($result instanceof ModelInterface) {
            if ($result->terminate()) {
                $result->setOption('has_parent', null);
            } else {
                $this->blockPool->add(
                    LayoutInterface::BLOCK_ID_ACTION_RESULT,
                    $result
                );
            }
        }
    }
}
