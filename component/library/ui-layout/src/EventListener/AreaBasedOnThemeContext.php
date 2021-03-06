<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Layout\EventListener;

use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use WellCart\Ui\Theme\Manager as ThemeManager;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;

class AreaBasedOnThemeContext implements
    ListenerAggregateInterface
{

    use ListenerAggregateTrait;

    /**
     * @var LayoutUpdaterInterface
     */
    protected $layoutUpdater;

    protected $themeManager;

    public function __construct(
        LayoutUpdaterInterface $layoutUpdater,
        ThemeManager $themeManager
    ) {
        $this->layoutUpdater = $layoutUpdater;
        $this->themeManager = $themeManager;
    }

  /**
   * @param EventManagerInterface $events
   * @param int                   $priority
   */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch']);
    }

    public function onDispatch(MvcEvent $e)
    {
        $area = $this->layoutUpdater->getArea();
        if (strpos($area, DS) === false) {
            $area = application_context() . '/' .
                'theme/' .
                $this->themeManager->getTheme();
            $this->layoutUpdater->setArea($area);
        }
    }
}
