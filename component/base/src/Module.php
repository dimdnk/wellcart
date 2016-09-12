<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base;

use ConLayout\ModuleManager\Feature\BlockProviderInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Locale;
use WellCart\Base\Entity\Locale\Language\DefaultLanguage;
use WellCart\Form\Form;
use WellCart\ModuleManager\Feature\DataFixturesProviderInterface;
use WellCart\ModuleManager\Feature\MigrationsProviderInterface;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\ModuleManager\Listener\ConfigListener;
use WellCart\ModuleManager\ModuleConfiguration;
use WellCart\Mvc;
use WellCart\Mvc\Controller\Plugin\Locale as LocaleControllerPlugin;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use WellCart\Ui\Datagrid\View\Helper\GridFilters as GridFiltersHelper;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use WellCart\View\Helper\Date as DateViewHelper;
use WellCart\View\Helper\Locale as LocaleViewHelper;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapter;
use Zend\EventManager\EventInterface;
use Zend\Form\Factory;
use Zend\ModuleManager\Feature;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;
use Zend\View\Helper\PaginationControl;
use Zend\View\HelperPluginManager;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements
    Feature\BootstrapListenerInterface,
    Feature\ConfigProviderInterface,
    Feature\ViewHelperProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\ConsoleUsageProviderInterface,
    Feature\ControllerPluginProviderInterface,
    ApigilityProviderInterface,
    Feature\ControllerProviderInterface,
    Feature\InitProviderInterface,
    Feature\FormElementProviderInterface,
    DataFixturesProviderInterface,
    MigrationsProviderInterface,
    VersionProviderInterface,
    ModulePathProviderInterface,
    BlockProviderInterface
{

    /**
     * Module version
     *
     * @var string
     */
    const VERSION = '0.1.0';

    /**
     * Retrieve module version
     *
     * @return string
     */
    final public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface|MvcEvent $e
     *
     * @return array|void
     */
    public function onBootstrap(EventInterface $e)
    {
        $app = $e->getApplication();

        /**
         * Setup application helper
         */
        application($app);

        $locale = Config::get('wellcart.localization.locale');

        ini_set('intl.default_locale', str_replace('_', '-', $locale));
        Locale::setDefault(str_replace('_', '-', $locale));

        setlocale(LC_TIME, $locale . '.utf-8');
        setlocale(LC_MONETARY, $locale . '.utf-8');

        if (PHP_SAPI == 'cli') {
            ini_set('max_execution_time', '0');
        } else {
            if (!headers_sent()) {
                header("Expires: Saturday, 03 March 2012 14:00:00 GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Pragma: no-cache");
            }
        }

        $serviceManager = $app->getServiceManager();

        if (session_status() !== PHP_SESSION_ACTIVE) {
            $serviceManager->get('Zend\Session\SessionManager');
        }

        /**
         * @var $translator \Zend\I18n\Translator\Translator
         */
        $translator = $serviceManager->get('translator');
        $translator->setLocale($locale);
        AbstractValidator::setDefaultTranslator($translator);

        $validatorPluginManager = $serviceManager->get('ValidatorManager');
        foreach (
            Config::get('validators.invokables', []) as $alias =>
            $invokableClass
        ) {
            $validatorPluginManager->setInvokableClass($alias, $invokableClass);
        }

        $viewHelperManager = $serviceManager->get('ViewHelperManager');

        $viewHelperManager->setAlias('jsEnv', 'javaScriptEnvironment');

        $viewHelperManager->setAlias('__', 'translate');
        $viewHelperManager->setAlias(
            'plural',
            'translateplural'
        );

        $viewHelperManager->get('form')->setTranslator(null);
        $viewHelperManager->get('formCollection')->setTranslator(null);
        $viewHelperManager->get('formRow')->setTranslator(null);
        $viewHelperManager->get('formElement')->setTranslator(null);
        $viewHelperManager->get('formLabel')->setTranslator(null);

        PaginationControl::setDefaultScrollingStyle('sliding');
        PaginationControl::setDefaultViewPartial('partial/paginator/default');

        $serviceManager->get('BlockManager')
            ->addPeeringServiceManager(
                $serviceManager
            );
    }

    /**
     * Initialize workflow
     *
     * @param  ModuleManagerInterface $manager
     *
     * @return void
     */
    public function init(ModuleManagerInterface $manager)
    {
        $events = $manager->getEventManager();
        $configListener = new ConfigListener();
        $events->attach($configListener, -70);
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return ModuleConfiguration
     */
    public function getConfig()
    {
        return new ModuleConfiguration([], true, __DIR__ . '/../config');
    }

    /**
     * Retrieve array of migration classes
     *
     * @return \WellCart\SchemaMigration\AbstractMigration[]
     */
    public function getMigrations(): array
    {
        return [
            '20161001000000' => new Setup\Schema\Install(
                '20161001000000'
            ),
        ];
    }

    /**
     * Retrieve array of data fixture classes
     *
     * @return \Doctrine\Common\DataFixtures\OrderedFixtureInterface[]
     */
    public function getDataFixtures(): array
    {
        return [
            '20161001000000' => new Setup\Data\Install(
                '20161001000000'
            ),
        ];
    }

    /**
     * Services configuration
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/../config/services.php';
    }

    /**
     * Controllers
     *
     * @return array
     */
    public function getControllerConfig()
    {
        return include __DIR__ . '/../config/controllers.php';
    }

    /**
     * Retrieve block config
     *
     * @return array
     */
    public function getBlockConfig()
    {
        return include __DIR__ . '/../config/blocks.php';
    }

    /**
     * Form elements
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getFormElementConfig()
    {
        return [
            'factories'    => [
                'localeLanguageSelector' =>
                    function (\Zend\Form\FormElementManager\FormElementManagerV2Polyfill $sm
                    ) {
                        $services = $sm->getServiceLocator();
                        $languages = $services->get(
                            'locale\active_languages_collection'
                        );
                        $options = [];
                        foreach ($languages as $language) {
                            $options[$language->getId()] = $language->getName();
                        }
                        return new \WellCart\Form\Element\Select(
                            null,
                            ['value_options' => $options]
                        );
                    },
                'translatableCollection' =>
                    function (\Zend\Form\FormElementManager\FormElementManagerV2Polyfill $sm
                    ) {
                        $services = $sm->getServiceLocator();
                        $languages = $services->get(
                            'locale\active_languages_collection'
                        );
                        return new \WellCart\Form\Element\TranslatableCollection(
                            null,
                            ['languages_collection' => $languages]
                        );
                    },
            ],
            'initializers' => [
                'ObjectManagerInitializer' => function ($element, $formElements
                ) {
                    if ($element instanceof ObjectManagerAwareInterface) {
                        $services = $formElements->getServiceLocator();
                        $entityManager = $services->get(
                            'Doctrine\ORM\EntityManager'
                        );
                        $element->setObjectManager($entityManager);
                    }
                },
            ],
        ];
    }

    /**
     * Expected to return absolute path to module directory
     *
     * @return string
     */
    public function getAbsolutePath()
    {
        return str_replace('\\', DS, dirname(__DIR__)) . DS;
    }

    /**
     * View helper configuration
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'gridFilters' => function (HelperPluginManager $sm) {
                    $locator = $sm->getServiceLocator();
                    $builder = $locator
                        ->get('ControllerPluginManager')
                        ->get('gridFilterBuilder');
                    $form = new Form();
                    $form->setFormFactory(
                        new Factory($locator->get('FormElementManager'))
                    );
                    $helper = new GridFiltersHelper($builder, $form);
                    return $helper;
                },
                'locale'      =>
                    function (HelperPluginManager $sm) {
                        $locale = $sm->getServiceLocator()
                            ->get('ControllerPluginManager')
                            ->get('locale');
                        $helper = new LocaleViewHelper($locale);
                        return $helper;
                    },
                'date'        =>
                    function (HelperPluginManager $sm) {
                        try {
                            $tz = $sm->getServiceLocator()
                                ->get(
                                    'Zend\Authentication\AuthenticationService'
                                )
                                ->getIdentity()
                                ->getTimeZone();
                        } catch (\Throwable $e) {
                            $tz = Config::get('wellcart.localization.timezone');
                        }

                        return new DateViewHelper($tz);
                    }
            ],
        ];
    }

    /**
     * Controller plugins
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerPluginConfig()
    {
        return [
            'factories'    => [
                'locale' => function ($sm) {
                    $services = $sm->getServiceLocator();
                    $translator = $services->get('MvcTranslator');
                    try {
                        $languages = $services->get(
                            'locale\active_languages_collection'
                        );
                        $defaultLanguage = $languages->current();
                    } catch (\Throwable $e) {
                        $languages
                            = new \Doctrine\Common\Collections\ArrayCollection(
                        );
                        $defaultLanguage = new DefaultLanguage();
                    }


                    return new LocaleControllerPlugin(
                        $languages,
                        $defaultLanguage,
                        $defaultLanguage,
                        $translator
                    );
                }
            ],
            'initializers' => [
                'WellCart\ServiceManager\ServiceLocatorAwareInterface' =>
                    function ($service, $sm) {
                        if ($service instanceof
                            ServiceLocatorAwareInterface
                        ) {
                            $service->setServiceLocator(
                                $sm->getServiceLocator()
                            );
                        }
                    },
                'ObjectManagerInitializer'                             =>
                    function (
                        $service,
                        $sm
                    ) {
                        if ($service instanceof ObjectManagerAwareInterface) {
                            $services = $sm->getServiceLocator();
                            $entityManager = $services->get(
                                'Doctrine\ORM\EntityManager'
                            );
                            $service->setObjectManager($entityManager);
                        }
                    },
            ],
        ];
    }

    /**
     * @param ConsoleAdapter $console
     *
     * @return array
     */
    public function getConsoleUsage(ConsoleAdapter $console)
    {
        return [
            "Flushes cache storage:\n",
            'wellcart:cache:flush' => '',
            "Display registered routes list:\n",
            'wellcart:route:list' => '',
        ];
    }
}
