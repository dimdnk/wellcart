<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;

use ConLayout\Block\BlockInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Interop\Container\ContainerInterface;
use WellCart\Base\EventListener;
use WellCart\Form\Form as ConfigEditorForm;
use WellCart\Hydrator;
use WellCart\Mvc;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\Session\SaveHandler\BlackHole as BlackHoleSessionSaveHandler;
use WellCart\Stdlib;
use WellCart\Ui\Container\LayoutView\Root as RootView;
use WellCart\Ui\Layout\LayoutManagerAwareInterface;
use WellCart\View\Renderer\ViewRendererAwareInterface;
use Zend\Console\Console;
use Zend\Form\Factory as FormFactory;
use Zend\Session\Container;
use Zend\Session\SessionManager;
use Zend\Session\Storage\ArrayStorage as BlackHoleSessionStorage;
use Zend\Stdlib\InitializableInterface;
use Zend\Validator\Csrf as CsrfValidator;

return [
    'factories'    => [
        Mvc\Application\MaintenanceMode::class =>
            function (ContainerInterface $services) {
                return $services->get('Application')
                    ->getMaintenanceMode();
            },

        PageView\Backend\LanguageForm::class    =>
            function (ContainerInterface $services) {
                return new PageView\Backend\LanguageForm(
                    $services->get(
                        Spec\LocaleLanguageRepository::class
                    )
                );
            },
        PageView\Backend\LanguagesGrid::class   =>
            function (ContainerInterface $services) {
                return new PageView\Backend\LanguagesGrid(
                    $services->get(
                        Spec\LocaleLanguageRepository::class
                    )
                );
            },
        PageView\Backend\UrlRewriteForm::class  =>
            function (ContainerInterface $services) {
                return new PageView\Backend\UrlRewriteForm(
                    $services->get(
                        Spec\UrlRewriteRepository::class
                    )
                );
            },
        PageView\Backend\UrlRewritesGrid::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\UrlRewritesGrid(
                    $services->get(
                        Spec\UrlRewriteRepository::class
                    )
                );
            },

        'system_configuration_editor'              =>
            function (ContainerInterface $services) {
                $form = new ConfigEditorForm;
                $form->setAttribute('action', '');
                $form->setFormFactory(
                    new FormFactory(
                        $services->get('FormElementManager')
                    )
                );
                $editor = new Service\ConfigurationEditor(
                    $services->get('Configuration'),
                    $form
                );
                $editor->setObjectManager(
                    $services->get('Doctrine\ORM\EntityManager')
                );

                return $editor;
            },
        Repository\Configuration::class            =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_base_object_manager')
                    ->getRepository(
                        Spec\ConfigurationEntity::class
                    );
            },
        Repository\UrlRewrites::class              =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_base_object_manager')
                    ->getRepository(
                        Spec\UrlRewriteEntity::class
                    );
            },
        Repository\Locale\Languages::class         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_base_object_manager')
                    ->getRepository(
                        Spec\LocaleLanguageEntity::class
                    );
            },
        Repository\Queue\Jobs::class               =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_base_object_manager')
                    ->getRepository(
                        Spec\JobQueueEntity::class
                    );
            },
        Form\Locale\Language::class                =>
            function (ContainerInterface $services) {
                $form = new Form\Locale\Language(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_base_doctrine_hydrator')
                );

                return $form;
            },
        Form\UrlRewrite::class                     =>
            function (ContainerInterface $services) {
                $form = new Form\UrlRewrite(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_base_doctrine_hydrator')
                );

                return $form;
            },
        EventListener\Ui\SetLayoutViewModel::class =>
            function (
                ContainerInterface $services
            ) {
                return new EventListener\Ui\SetLayoutViewModel(
                    $services->get('RootView')
                );
            },
        'Zend\Session\SessionManager'              =>
            function (
                ContainerInterface $services
            ) {
                $config = $services->get('config');
                if (isset($config['session'])) {
                    $session = $config['session'];
                    $sessionConfig = null;
                    if (isset($session['config'])) {
                        $class = isset($session['config']['class'])
                            ? $session['config']['class']
                            : 'Zend\Session\Config\SessionConfig';
                        $options = isset($session['config']['options'])
                            ? $session['config']['options'] : [];
                        $sessionConfig = new $class();
                        $sessionConfig->setOptions($options);
                    }

                    $sessionStorage = null;
                    $sessionSaveHandler = null;
                    if (Console::isConsole()) {
                        global $_SESSION;
                        $_SESSION = [];
                        $sessionStorage = new BlackHoleSessionStorage;
                        $sessionSaveHandler = new BlackHoleSessionSaveHandler;
                    } else {
                        if (isset($session['storage'])) {
                            $class = $session['storage'];
                            $sessionStorage = new $class();
                        }
                        if (isset($session['save_handler'])) {
                            // class should be fetched from service manager since it will require constructor arguments
                            $sessionSaveHandler = $services->get(
                                $session['save_handler']
                            );
                        }
                    }

                    $sessionManager = new SessionManager(
                        $sessionConfig,
                        $sessionStorage,
                        $sessionSaveHandler
                    );

                    if (isset($session['validator'])) {
                        $chain = $sessionManager->getValidatorChain();
                        foreach ($session['validator'] as $validator) {
                            $validator = new $validator();
                            $chain->attach(
                                'session.validate',
                                [$validator, 'isValid']
                            );
                        }
                    }
                } else {
                    $sessionManager = new SessionManager();
                }
                Container::setDefaultManager($sessionManager);

                return $sessionManager;
            },
        'base_csrf_validator'
                                                   =>
            function (ContainerInterface $services
            ) {
                return (
                new CsrfValidator(
                    [
                        'name' => 'base_csrf_validator',
                    ]
                )
                )
                    ->setSession($services->get('CsrfSessionContainer'));
            },


        'doctrine_hydrator'                  =>
            function (ContainerInterface $services) {
                return new Hydrator\DoctrineObject(
                    $services->get('wellcart_base_object_manager')
                );
            },
        'locale\active_languages_collection' =>
            function (ContainerInterface $services) {
                return $services->get(
                    Spec\LocaleLanguageRepository::class
                )
                    ->finder()
                    ->active()
                    ->prioritize()
                    ->findAll();
            },
    ],
    'initializers' => [
        'Zend\Log\LoggerAwareInterface'
                                                               =>
            function ($service, $services) {
                if ($service instanceof \Zend\Log\LoggerAwareInterface
                ) {
                    $logger = $services->get('logger');
                    $service->setLogger($logger);
                }
            },
        'Zend\I18n\Translator\TranslatorAwareInterface'
                                                               =>
            function ($service, $services) {
                if ($service instanceof
                    \Zend\I18n\Translator\TranslatorAwareInterface
                ) {
                    $translator = $services->get('translator');
                    $service->setTranslator($translator);
                }
            },
        'WellCart\Mvc\Controller\PluginManagerAwareInterface'  =>
            function ($service, $services) {
                if ($service instanceof
                    Mvc\Controller\PluginManagerAwareInterface
                ) {
                    $plugins = $services->get('ControllerPluginManager');
                    $service->setControllerPlugins($plugins);
                }
            },
        'WellCart\Ui\Layout\LayoutManagerAwareTrait'           =>
            function ($service, $services) {
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
            function ($service, $services) {
                if ($service instanceof Stdlib\RequestAwareInterface) {
                    $request = $services->get('Request');
                    $service->setRequest($request);
                }
                if (!Console::isConsole()
                    && $service instanceof BlockInterface
                ) {
                    $request = $services->get('Request');
                    $service->setRequest($request);
                }
            },
        'WellCart\Stdlib\ResponseAwareInterface'               =>
            function ($service, $services) {
                if ($service instanceof Stdlib\ResponseAwareInterface) {
                    $response = $services->get('Response');
                    $service->setResponse($response);
                }
            },
        'WellCart\View\Renderer\ViewRendererAwareInterface'    =>
            function ($service, $services) {
                if ($service instanceof ViewRendererAwareInterface
                    && !$service instanceof RootView
                ) {
                    $viewRenderer = $services->get('ViewRenderer');
                    $service->setView($viewRenderer);
                    if (method_exists($service, 'setRootView')) {
                        $service->setRootView($services->get('RootView'));
                    }
                }
            },
        'WellCart\ServiceManager\ServiceLocatorAwareInterface' =>
            function ($service, $services) {
                if ($service instanceof
                    ServiceLocatorAwareInterface
                ) {
                    $service->setServiceLocator($services);
                }
            },
        'Zend\Stdlib\InitializableInterface'                   =>
            function ($service, $services) {
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
                    $entityManager = $services->get(
                        'Doctrine\ORM\EntityManager'
                    );
                    $service->setObjectManager($entityManager);
                }
            },
    ],
];
