<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Ui;

use WellCart\Utility\Config;
use Zend\Console\Console;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

class InitTheme extends AbstractListenerAggregate
{

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            [$this, 'init'],
            -100
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER_ERROR,
            [$this, 'init'],
            -100
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH_ERROR,
            [$this, 'init'],
            -100
        );
    }

    /**
     * Initialize theme
     *
     * @param MvcEvent $e
     */
    public function init(MvcEvent $e)
    {
        $currentLayout = $e->getViewModel();
        if ($currentLayout instanceof JsonModel || Console::isConsole()) {
            return;
        }

        $services = $e->getApplication()->getServiceManager();

        $viewHelpers = $services->get('ViewHelperManager');
        $requireJS = $viewHelpers->get('RequireJS');
        $requireJS->__invoke();

        /**
         * @var $themeManager \WellCart\Ui\Theme\Manager
         */
        $themeManager = $services->get('WellCart\Ui\Theme\Manager');

        $theme = $themeManager->getTheme();
        $themeConfig = $themeManager->getThemeConfig($theme);
        Config::merge($themeConfig);
        $viewHelpers->get('bodyClass')->addClass('theme-' . $theme);
    }
}
