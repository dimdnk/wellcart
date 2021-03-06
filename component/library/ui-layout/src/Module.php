<?php
namespace WellCart\Ui\Layout;

use WellCart\Ui\Layout\Filter\DebugFilter;
use WellCart\Ui\Layout\Layout\LayoutInterface;
use WellCart\Ui\Layout\ModuleManager\Feature\BlockProviderInterface;
use WellCart\Ui\Layout\Options\ModuleOptions;
use Zend\EventManager\EventInterface as Event;
use Zend\EventManager\EventInterface;
use Zend\Http\PhpEnvironment\Request;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\FilterProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;

/**
 * @package WellCart\Ui\Layout
 
 */
class Module implements
    ConfigProviderInterface,
    ServiceProviderInterface,
    ViewHelperProviderInterface,
    BootstrapListenerInterface,
    InitProviderInterface,
    FilterProviderInterface
{
    /**
     * retrieve module config
     *
     * @return array
     */
    public function getConfig()
    {
        return array_merge(
            include __DIR__ . '/../config/module.config.php',
            include __DIR__ . '/../config/layout.global.php'
        );
    }

    /**
     * retrieve view helpers
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        return include __DIR__ . '/../config/viewhelper.config.php';
    }

    /**
     * retrieve filters
     *
     * @return array
     */
    public function getFilterConfig()
    {
        return include __DIR__ . '/../config/filter.config.php';
    }

    /**
     * retrieve services
     *
     * @return array
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/../config/service.config.php';
    }

    /**
     *
     * @param ModuleManagerInterface $manager
     */
    public function init(ModuleManagerInterface $manager)
    {
        $sm = $manager->getEvent()->getParam('ServiceManager');
        $serviceListener = $sm->get('ServiceListener');

        $serviceListener->addServiceManager(
            'BlockManager',
            'blocks',
            BlockProviderInterface::class,
            'getBlockConfig'
        );
    }

    /**
     *
     * @param MvcEvent|EventInterface $e
     * @return array|void
     */
    public function onBootstrap(Event $e)
    {
        $application    = $e->getApplication();
        $serviceManager = $application->getServiceManager();
        $eventManager   = $application->getEventManager();
        $request        = $serviceManager->get('Request');

        if (!$request instanceof Request) {
            return;
        }

        /* @var $options ModuleOptions */
        $options = $serviceManager->get(ModuleOptions::class);
        $listeners = $options->getListeners();

        foreach ($listeners as $listener => $isEnabled) {
            if ($isEnabled) {
                 $serviceManager->get($listener)->attach($eventManager);
            }
        }

        $serviceManager->get(LayoutInterface::class)->setRoot($e->getViewModel());

        if ($options->isDebug()) {
            $this->attachDebugger($serviceManager);
        }
    }

    /**
     * @param ServiceLocatorInterface $serviceManager
     */
    private function attachDebugger(ServiceLocatorInterface $serviceManager)
    {
        /** @var PhpRenderer $renderer */
        $renderer = $serviceManager->get(PhpRenderer::class);
        $filterManager = $serviceManager->get('FilterManager');
        $renderer->getFilterChain()->attach($filterManager->get(DebugFilter::class));
    }
}
