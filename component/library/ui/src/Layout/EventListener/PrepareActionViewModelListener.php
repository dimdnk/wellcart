<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Layout\EventListener;

use ConLayout\Block\BlockPoolInterface;
use ConLayout\Layout\LayoutInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ModelInterface;

class PrepareActionViewModelListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @var LayoutInterface
     */
    private $blockPool;

    /**
     * PrepareActionViewModelListener constructor.
     *
     * @param BlockPoolInterface $blockPool
     */
    public function __construct(BlockPoolInterface $blockPool)
    {
        $this->blockPool = $blockPool;
    }

    /**
     *
     * @param EventManagerInterface $events
     * @param int                   $priority
     */
    public function attach(EventManagerInterface $events, $priority = -1)
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
                $blocks = $this->blockPool->get();
                foreach ($blocks as $block) {
                    $block->setActionResult($result);
                    if ($block->getOption('parent') == 'action.result') {
                        $result->addChild($block, $block->captureTo(), true);
                    }
                }
            }
        }
    }
}

