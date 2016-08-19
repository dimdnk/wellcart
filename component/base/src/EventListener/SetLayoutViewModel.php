<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener;

use WellCart\Ui\Container\LayoutView\Root;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class SetLayoutViewModel extends AbstractListenerAggregate
{
    /**
     * @var Root
     */
    protected $rootView;

    public function __construct(Root $rootView)
    {
        $this->rootView = $rootView;
    }

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_BOOTSTRAP,
            [$this, 'setViewModel'],
            10001
        );
    }

    /**
     * Set View Model
     *
     * @param MvcEvent $e
     */
    public function setViewModel(MvcEvent $e)
    {
        $e->setViewModel($this->rootView);
    }
}
