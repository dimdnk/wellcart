<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;

use WellCart\Ui\Layout\Block\BlockInterface;
use WellCart\Ui\Layout\BlockManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use WellCart\Mvc;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\Stdlib\RequestAwareInterface;
use WellCart\Stdlib\ResponseAwareInterface;
use WellCart\Ui\Container\LayoutView\Root;
use WellCart\Ui\Layout\LayoutManagerAwareInterface;
use WellCart\View\Renderer\ViewRendererAwareInterface;
use Zend\Console\Console;
use Zend\Stdlib\InitializableInterface;

return [
    'factories'    => [
        ItemView\Text::class     =>
            function (BlockManager $sm) {
                return new ItemView\Text();
            },
        ItemView\HtmlHead::class =>
            function (BlockManager $sm) {
                return new ItemView\HtmlHead(
                    [],
                    [],
                    $sm->getServiceLocator()
                        ->get('base_csrf_validator')
                );
            },
    ],
    'shared'       => [
        ItemView\Text::class     => false,
        ItemView\HtmlHead::class => false,
    ],
    'initializers' => [
        'Zend\Log\LoggerAwareInterface'
                                                               =>
            function ($service, BlockManager $services) {
                if ($service instanceof \Zend\Log\LoggerAwareInterface
                ) {
                    $logger = $services->getServiceLocator()->get(
                        'logger'
                    );
                    $service->setLogger($logger);
                }
            },
        'Zend\I18n\Translator\TranslatorAwareInterface'
                                                               =>
            function ($service, BlockManager $services) {
                if ($service instanceof
                    \Zend\I18n\Translator\TranslatorAwareInterface
                ) {
                    $translator = $services->getServiceLocator()->get(
                        'translator'
                    );
                    $service->setTranslator($translator);
                }
            },
        'WellCart\Mvc\Controller\PluginManagerAwareInterface'  =>
            function ($service, BlockManager $services) {
                if ($service instanceof
                    Mvc\Controller\PluginManagerAwareInterface
                ) {
                    $plugins = $services->getServiceLocator()->get(
                        'ControllerPluginManager'
                    );
                    $service->setControllerPlugins($plugins);
                }
            },
        'WellCart\Ui\Layout\LayoutManagerAwareTrait'           =>
            function ($service, BlockManager $services) {
                if ($service instanceof
                    LayoutManagerAwareInterface
                ) {
                    $manager = $services
                        ->get('ControllerPluginManager')
                        ->get('layoutManager');
                    $service->setLayoutManager($manager);
                }
            },
        'WellCart\Stdlib\RequestAwareInterface'                =>
            function ($service, BlockManager $services) {
                if ($service instanceof RequestAwareInterface) {
                    $request = $services->getServiceLocator()->get(
                        'Request'
                    );
                    $service->setRequest($request);
                }
                if (!Console::isConsole()
                    && $service instanceof BlockInterface
                ) {
                    $request = $services->getServiceLocator()->get(
                        'Request'
                    );
                    $service->setRequest($request);
                }
            },
        'WellCart\Stdlib\ResponseAwareInterface'               =>
            function ($service, BlockManager $services) {
                if ($service instanceof ResponseAwareInterface) {
                    $response = $services->getServiceLocator()->get(
                        'Response'
                    );
                    $service->setResponse($response);
                }
            },
        'WellCart\View\Renderer\ViewRendererAwareInterface'    =>
            function ($service, BlockManager $services) {
                if ($service instanceof ViewRendererAwareInterface
                    && !$service instanceof Root
                ) {
                    $viewRenderer = $services->getServiceLocator()->get(
                        'ViewRenderer'
                    );
                    $service->setView($viewRenderer);
                    if (method_exists($service, 'setRootView')) {
                        $service->setRootView(
                            $services->getServiceLocator()->get(
                                'RootView'
                            )
                        );
                    }
                }
            },
        'WellCart\ServiceManager\ServiceLocatorAwareInterface' =>
            function ($service, BlockManager $services) {
                if ($service instanceof
                    ServiceLocatorAwareInterface
                ) {
                    $service->setServiceLocator($services);
                }
            },
        'Zend\Stdlib\InitializableInterface'                   =>
            function ($service, BlockManager $services) {
                if ($service instanceof InitializableInterface) {
                    if ($service instanceof
                        ServiceLocatorAwareInterface
                    ) {
                        $service->setServiceLocator($services);
                    }
                    $service->init();
                }
            },
        'ObjectManagerInitializer'                             =>
            function (
                $service,
                $services
            ) {
                if ($service instanceof ObjectManagerAwareInterface) {
                    $entityManager = $services->getServiceLocator()
                        ->get(
                            'Doctrine\ORM\EntityManager'
                        );
                    $service->setObjectManager($entityManager);
                }
            },
    ],
];
