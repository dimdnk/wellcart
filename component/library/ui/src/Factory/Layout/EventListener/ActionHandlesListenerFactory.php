<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Factory\Layout\EventListener;

use WellCart\Ui\Layout\Options\ModuleOptions;
use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use Interop\Container\ContainerInterface;
use WellCart\Ui\Layout\EventListener\ActionHandlesListener;

class ActionHandlesListenerFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return ActionHandlesListener
     */
    public function __invoke(ContainerInterface $container
    ): ActionHandlesListener {
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