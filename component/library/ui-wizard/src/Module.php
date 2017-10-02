<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements ConfigProviderInterface
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $application    = $e->getApplication();
        $serviceManager = $application->getServiceManager();

        $dispatchListener = $serviceManager->get('WellCart\Ui\Wizard\Listener\DispatchListener');
        $application->getEventManager()->attach($dispatchListener);
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
