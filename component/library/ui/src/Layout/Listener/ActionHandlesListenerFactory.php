<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Layout\Listener;

use ConLayout\Options\ModuleOptions;
use ConLayout\Updater\LayoutUpdaterInterface;
use Interop\Container\ContainerInterface;

class ActionHandlesListenerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ActionHandlesListener
     */
    public function __invoke(ContainerInterface $container
    ): ActionHandlesListener
    {
        /* @var $moduleOptions ModuleOptions */
        $moduleOptions = $container->get(ModuleOptions::class);
        $updater = $container->get(LayoutUpdaterInterface::class);
        $actionHandlesListener = new ActionHandlesListener();
        $actionHandlesListener->setUpdater($updater);
        $actionHandlesListener->setControllerMap(
            $moduleOptions->getControllerMap()
        );
        $actionHandlesListener->setPreferRouteMatchController(
            $moduleOptions->isPreferRouteMatchController()
        );
        return $actionHandlesListener;
    }
}