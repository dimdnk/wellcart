<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;

use WellCart\Form\Element as FormElement;
use WellCart\View\Factory\Helper\MessengerFactory;
use WellCart\View\Helper as ViewHelper;
use Zend\Http\Response;

return [
    'wellcart'        => [
        'website'              => [
            'name' => 'Demo Application',
        ],
        'maintenance'          => [
            'message'     => 'Service Temporarily Unavailable',
            'status_code' => Response::STATUS_CODE_503,
            'template'    => __DIR__ . '/../data/Maintenance.html',
        ],
        'localization'         =>
            [
                'country_code' => 'GB',
                'timezone'     => 'Etc/GMT',
                'locale'       => 'en_US',
            ],
        'email_communications' => [
            'enabled'  => true,
            'contacts' => [
                'general'               => [
                    'name'  => 'Default Website Owner',
                    'email' => 'owner@example.com',
                ],
                'support'               => [
                    'name'  => 'Default Website Customer Support',
                    'email' => 'support@example.com',
                ],
                'website_administrator' => [
                    'name'  => 'Default Website Administrator',
                    'email' => 'admin@example.com',
                ],
            ],
        ],
            'doctrine'             => ['global_cache_instance' => 'array',]
    ],

    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager' => [
        'factories'          => [
            'Application'                                                => 'WellCart\Mvc\Factory\ApplicationFactory',
            'stroker_form.renderer'                                      => 'WellCart\Form\Factory\StrokerForm\RendererFactory',
            'Zend\Db\Adapter\Adapter'                                    => 'WellCart\Db\Factory\Adapter\MasterSlaveAdapterFactory',
            'ZeThemeManager'                                             => 'WellCart\Ui\Factory\Theme\ManagerFactory',
            'ZfcDatagrid\Datagrid'                                       => 'WellCart\Ui\Factory\Datagrid\DatagridFactory',
            'WellCart\Ui\Layout\Listener\AreaBasedOnThemeContext'        => 'WellCart\Ui\Factory\Layout\Listener\AreaBasedOnThemeContextFactory',
            'WellCart\Ui\Layout\Listener\ActionHandlesListener'          => 'WellCart\Ui\Factory\Layout\Listener\ActionHandlesListenerFactory',
            'WellCart\Ui\Layout\Listener\LoadLayoutListener'             => 'WellCart\Ui\Factory\Layout\Listener\LoadLayoutListenerFactory',
            'WellCart\Ui\Layout\Listener\PrepareActionViewModelListener' => 'WellCart\Ui\Factory\Layout\Listener\PrepareActionViewModelListenerFactory',
            'Router'                                                     => 'Zend\Mvc\Service\RouterFactory',
            'RoutePluginManager'                                         => 'Zend\Mvc\Service\RoutePluginManagerFactory',
            'HttpRouter'                                                 => 'Zend\Mvc\Service\HttpRouterFactory',
            Service\Route\Listing::class                                 => Factory\Service\Route\ListingFactory::class,

        ],
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory'    => 'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory'                    => 'Zend\Log\LoggerAbstractServiceFactory',
            'Zend\Session\Service\ContainerAbstractServiceFactory'     => 'Zend\Session\Service\ContainerAbstractServiceFactory',
            'Zend\Db\Adapter\AdapterAbstractServiceFactory'            => 'Zend\Db\Adapter\AdapterAbstractServiceFactory',
            'Zend\Form\FormAbstractServiceFactory'                     => 'Zend\Form\FormAbstractServiceFactory',
            'Zend\Navigation\Service\NavigationAbstractServiceFactory' => 'Zend\Navigation\Service\NavigationAbstractServiceFactory',
        ],
        'invokables'         => [
            'Doctrine\DBAL\Logging\DebugStack'                      => 'Doctrine\DBAL\Logging\DebugStack',
            Service\Cache\Flusher::class                            => Service\Cache\Flusher::class,
            EventListener\SetupRouterBaseUrl::class                 => EventListener\SetupRouterBaseUrl::class,
            EventListener\SetupPageVariables::class                 => EventListener\SetupPageVariables::class,
            EventListener\InitTheme::class                          => EventListener\InitTheme::class,
            EventListener\LogException::class                       => EventListener\LogException::class,
            EventListener\NormalizeViewManagerBasePath::class       => EventListener\NormalizeViewManagerBasePath::class,
            EventListener\DoctrineGlobalCacheChanger::class         => EventListener\DoctrineGlobalCacheChanger::class,
            EventListener\PrepareLayoutItemView::class              => EventListener\PrepareLayoutItemView::class,
            ItemView\Text::class                                    => ItemView\Text::class,
            ItemView\HtmlNotices::class                             => ItemView\HtmlNotices::class,
            ItemView\Notifications::class                           => ItemView\Notifications::class,
            ItemView\FlashNotifications::class                      => ItemView\FlashNotifications::class,
            ItemView\HtmlFooter::class                              => ItemView\HtmlFooter::class,
            ItemView\Copyright::class                               => ItemView\Copyright::class,
            'Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy' => 'Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy',
            'StandardItemView'                                      => 'WellCart\Ui\Container\ItemView\ItemView',
            'StandardPageView'                                      => 'WellCart\Ui\Container\PageView\PageView',
            'RootView'                                              => 'WellCart\Ui\Container\LayoutView\Root',
            'StandardLayoutView'                                    => 'WellCart\Ui\Container\LayoutView\LayoutView',
            'StandardViewModel'                                     => 'WellCart\View\Model\ViewModel',
            'StandardConsoleModel'                                  => 'WellCart\View\Model\ConsoleModel',
            'StandardFeedModel'                                     => 'WellCart\View\Model\FeedModel',
            'StandardHalJsonModel'                                  => 'WellCart\View\Model\HalJsonModel',
            'StandardJsonModel'                                     => 'WellCart\View\Model\JsonModel',
            'WellCart\ORM\Repository\RepositoryFactory'             => 'WellCart\ORM\Repository\RepositoryFactory',
            'WellCart\ORM\Mapping\EntityListenerResolver'           => 'WellCart\ORM\Mapping\EntityListenerResolver',
        ],
        'aliases'            => [
            'translator'                         => 'MvcTranslator',
            'UnderscoreNamingStrategy'           => 'Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy',
            'wellcart_base_db_adapter'           => 'Zend\Db\Adapter\Adapter',
            'wellcart_base_object_manager'       => 'Doctrine\ORM\EntityManager',
            'wellcart_base_doctrine_hydrator'    => 'doctrine_hydrator',
            Spec\ConfigurationRepository::class  => Repository\Configuration::class,
            Spec\UrlRewriteRepository::class     => Repository\UrlRewrites::class,
            Spec\LocaleLanguageRepository::class => Repository\Locale\Languages::class,
            Spec\JobQueueRepository::class       => Repository\Queue\Jobs::class,
        ],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            ItemView\HtmlNotices::class           => false,
            ItemView\Notifications::class         => false,
            ItemView\FlashNotifications::class    => false,
            ItemView\HtmlFooter::class            => false,
            ItemView\Copyright::class             => false,
            PageView\Admin\LanguagesGrid::class   => false,
            PageView\Admin\LanguageForm::class    => false,
            PageView\Admin\UrlRewritesGrid::class => false,
            PageView\Admin\UrlRewriteForm::class  => false,
            ItemView\Text::class                  => false,
            'StandardItemView'                    => false,
            'StandardPageView'                    => false,
            'RootView'                            => true,
            'StandardLayoutView'                  => false,
            'StandardViewModel'                   => false,
            'StandardConsoleModel'                => false,
            'StandardFeedModel'                   => false,
            'StandardHalJsonModel'                => false,
            'StandardJsonModel'                   => false,
            'ZfcDatagrid\Datagrid'                => false,
        ],
    ],

    'db'            => [
        'driver'         => 'pdo_mysql',
        'username'       => 'root',
        'password'       => '',
        'port'           => 3306,
        'host'           => 'localhost',
        'database'       => 'wellcart',
        'driver_options' => [
            1002 => "SET NAMES UTF8 COLLATE utf8_general_ci"
        ],
        'options'        => [
            'buffer_results' => true,
        ],
    ],
    'listeners'     => [
        'WellCart\Ui\Layout\Listener\AreaBasedOnThemeContext'        => 'WellCart\Ui\Layout\Listener\AreaBasedOnThemeContext',
        'WellCart\Ui\Layout\Listener\ActionHandlesListener'          => 'WellCart\Ui\Layout\Listener\ActionHandlesListener',
        'WellCart\Ui\Layout\Listener\LoadLayoutListener'             => 'WellCart\Ui\Layout\Listener\LoadLayoutListener',
        'WellCart\Ui\Layout\Listener\PrepareActionViewModelListener' => 'WellCart\Ui\Layout\Listener\PrepareActionViewModelListener',

        EventListener\SetLayoutViewModel::class => EventListener\SetLayoutViewModel::class,
        EventListener\SetupRouterBaseUrl::class => EventListener\SetupRouterBaseUrl::class,
        EventListener\SetupPageVariables::class => EventListener\SetupPageVariables::class,
        EventListener\InitTheme::class          => EventListener\InitTheme::class,
        EventListener\LogException::class       => EventListener\LogException::class,
    ],
    'event_manager' => include __DIR__
        . '/section/event_manager.php',

    'input_filters'        => [
        'abstract_factories' => [
            'WellCart\InputFilter\InputFilterAbstractServiceFactory' => 'WellCart\InputFilter\InputFilterAbstractServiceFactory',
        ],
    ],

    /**
     * =========================================================
     * Cache manager configuration
     * =========================================================
     */
    'caches'               => [
        'cache_base_transient'   =>
            [
                'adapter' => [
                    'name'    => 'filesystem',
                    'options' => [
                        'ttl'                => 3600,
                        'dirLevel'           => 1,
                        'cacheDir'           => WELLCART_STORAGE_PATH
                            . 'cache/',
                        'dirPermission'      => 0777,
                        'filePermission'     => 0666,
                        'umask'              => 0,
                        'namespaceSeparator' => '-base-transient-',
                    ],
                ],
                'plugins' => [
                    'serializer'        => [],
                    'exception_handler' =>
                        [
                            'throw_exceptions' => false
                        ],
                ],
            ],
        'cache_base_persistence' =>
            [
                'adapter' => [
                    'name'    => 'filesystem',
                    'options' => [
                        'ttl'                => 86400,
                        'dirLevel'           => 1,
                        'cacheDir'           => WELLCART_STORAGE_PATH
                            . 'cache/',
                        'dirPermission'      => 0777,
                        'filePermission'     => 0666,
                        'umask'              => 0,
                        'namespaceSeparator' => '-base-persistence-',
                    ],
                ],
                'plugins' => [
                    'serializer'        => [],
                    'exception_handler' =>
                        [
                            'throw_exceptions' => false
                        ],
                ],
            ],
    ],
    'acmailer_options'     => include __DIR__
        . '/section/acmailer_options.php',
    'system_config_editor' => include __DIR__
        . '/section/system_config_editor.php',

    /**
     * Session configuration
     */
    'session'              => include __DIR__ . '/section/session.php',

    /**
     * =========================================================
     * Object mapping configuration
     * =========================================================
     */
    'object_mapping'       => include __DIR__
        . '/section/object_mapping.php',

    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'             => include __DIR__ . '/section/doctrine.php',

    'doctrine_factories' => [
        'sql_logger_collector' => 'WellCart\ORM\SQLLoggerCollectorFactory',
    ],

    'doctrineviewer'     => [
        /**
         *  Doctrine object manager name
         */
        'object_manager_name' => 'doctrine.entitymanager.orm_default',
    ],
    'rdn_require_js'     => include __DIR__
        . '/section/rdn_require_js.php',

    /**
     * =========================================================
     * Translator configuration
     * =========================================================
     */
    'translator'         => include __DIR__ . '/section/translator.php',

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'             =>
        [
            'router_class' => 'WellCart\Router\Http\TreeRouteStack',
            'base_path'    => '/',
            'routes'       => include __DIR__ . '/section/routes.php',
        ],


    /**
     * =========================================================
     * View manager configuration
     * =========================================================
     */
    'view_manager'       => include __DIR__
        . '/section/view_manager.php',
    'zenddevelopertools' => include __DIR__
        . '/section/zenddevelopertools.php',
    'view_helper_config' => [],

    'con-layout'                 => [
        'enable_debug'                   => true,
        'default_area'                   => \WellCart\Mvc\Application::CONTEXT_GLOBAL,
        'prefer_route_match_controller'  => true,
        'cache_buster_internal_base_dir' => WELLCART_PUBLIC_PATH,
        'block_defaults'                 => [
            'capture_to' => 'content',
            'append'     => true,
            'class'      => 'WellCart\Ui\Container\ItemView\ItemView',
            'options'    => [],
            'variables'  => [],
            'template'   => '',
            'actions'    => [],
            'wrapper'    => false
        ],
        'layout_update_extensions'       => [
            'xml' => false,
        ],
        'listeners'                      => [
            'ConLayout\Listener\ActionHandlesListener'          => false,
            'ConLayout\Listener\LoadLayoutListener'             => false,
            'ConLayout\Listener\PrepareActionViewModelListener' => false,
        ],
        /**
         * available view helpers for view_helpers-instructions
         */
        'view_helpers'                   => [
            'requireJS'             => [
                'method' => '__invoke'
            ],
            'javaScriptEnvironment' => [
                'method' => 'set'
            ],
        ],
    ],
    'controllers'                => [
        'aliases' => [
            'Base::Console\Cache'     => Controller\Console\CacheController::class,
            'Base::Console\Route'     => Controller\Console\RouteController::class,
            'Base::Index'             => Controller\IndexController::class,
            'Base::Admin\Languages'   => Controller\Admin\LanguagesController::class,
            'Base::Admin\UrlRewrites' => Controller\Admin\UrlRewritesController::class,
        ],

        'invokables' => [
            Controller\Console\CacheController::class => Controller\Console\CacheController::class,
            Controller\Console\RouteController::class => Controller\Console\RouteController::class,
        ],
        'factories'  => [
            Controller\IndexController::class             => Factory\Controller\IndexControllerFactory::class,
            Controller\Admin\LanguagesController::class   => Factory\Controller\Admin\LanguagesControllerFactory::class,
            Controller\Admin\UrlRewritesController::class => Factory\Controller\Admin\UrlRewritesControllerFactory::class,

            'TckImageResizer\Controller\Index' => Factory\Controller\ImageResizeControllerFactory::class,
        ],
    ],

    /**
     * =========================================================
     * View helper manager configuration
     * =========================================================
     */
    'view_helpers'               => [
        'aliases'    => [
            'gridFilters' => \WellCart\Ui\Datagrid\View\Helper\GridFilters::class,
            'locale'      => \WellCart\View\Helper\Locale::class,
            'date'        => \WellCart\View\Helper\Date::class,
        ],
        'factories'  => [
            'messenger'   => MessengerFactory::class,
            'formElement' => 'WellCart\Form\View\Helper\Service\FormElementFactory',

            \WellCart\Ui\Datagrid\View\Helper\GridFilters::class => \WellCart\Ui\Factory\Datagrid\ViewHelper\GridFiltersFactory::class,
            \WellCart\View\Helper\Locale::class                  => \WellCart\View\Factory\Helper\LocaleFactory::class,
            \WellCart\View\Helper\Date::class                    => \WellCart\View\Factory\Helper\DateFactory::class
        ],
        'invokables' => [
            'assetPath'             => ViewHelper\AssetPath::class,
            'mediaPath'             => ViewHelper\MediaPath::class,
            'themePath'             => ViewHelper\ThemePath::class,
            'resizeImage'           => ViewHelper\ResizeImage::class,
            'headLink'              => ViewHelper\HeadLink::class,
            'headScript'            => ViewHelper\HeadScript::class,
            'inlineScript'          => ViewHelper\InlineScript::class,
            'form'                  => 'WellCart\Form\View\Helper\Form',
            'formSelect'            => 'WellCart\Form\View\Helper\FormSelect',
            'formLabel'             => 'WellCart\Form\View\Helper\FormLabel',
            'formButton'            => 'WellCart\Form\View\Helper\FormButton',
            'formCheckbox'          => 'WellCart\Form\View\Helper\FormCheckbox',
            'formCollection'        => 'WellCart\Form\View\Helper\FormCollection',
            'formElementErrors'     => 'WellCart\Form\View\Helper\FormElementErrors',
            'formMultiCheckbox'     => 'WellCart\Form\View\Helper\FormMultiCheckbox',
            'formRadio'             => 'WellCart\Form\View\Helper\FormRadio',
            'formRow'               => 'WellCart\Form\View\Helper\FormRow',
            'formStatic'            => 'WellCart\Form\View\Helper\FormStatic',
            'formErrors'            => 'WellCart\Form\View\Helper\FormErrors',
            'javaScriptEnvironment' => ViewHelper\JavaScriptEnvironment::class,
            'formRenderer'          => 'WellCart\Form\View\Helper\FormRenderer',
            'formHtmlAnchor'        => 'WellCart\Form\View\Helper\FormHtmlAnchor',
            'formDateRange'         => 'WellCart\Form\View\Helper\FormDateRange',
            'formRangeFilter'       => 'WellCart\Form\View\Helper\FormRangeFilter',
            'formTabsRenderer'      => 'WellCart\Ui\Form\Helper\FormTabsRenderer',
            'alert'                 => 'WellCart\Ui\Helper\Alert',
            'badge'                 => 'WellCart\Ui\Helper\Badge',
            'buttonGroup'           => 'WellCart\Ui\Helper\ButtonGroup',
            'dropDown'              => 'WellCart\Ui\Helper\DropDown',
            'glyphicon'             => 'WellCart\Ui\Helper\Glyphicon',
            'label'                 => 'WellCart\Ui\Helper\Label',
            'chosen'                => 'WellCart\Ui\Helper\Chosen',
            'button'                => 'WellCart\Ui\Helper\Button',
            'image'                 => 'WellCart\Ui\Helper\Image',
            'well'                  => 'WellCart\Ui\Helper\Well',
        ],
    ],
    'validators'                 => [
        'invokables' => [
            'filesize'      => 'WellCart\Validator\File\Size',
            'filemimetype'  => 'WellCart\Validator\File\MimeType',
            'fileimagesize' => 'WellCart\Validator\File\ImageSize',
            'fileisimage'   => 'WellCart\Validator\File\IsImage',
        ],
    ],
    'controller_plugins'         => [
        'aliases'    => [
            'locale' => \WellCart\Mvc\Controller\Plugin\Locale::class,
        ],
        'factories'  => [
            \WellCart\Mvc\Controller\Plugin\Locale::class => \WellCart\Mvc\Factory\ControllerPlugin\LocalePluginFactory::class,
        ],
        'invokables' => [
            'gridFilterBuilder'  => 'WellCart\Ui\Datagrid\Controller\Plugin\GridFilterBuilder',
            'redirect'           => 'WellCart\Mvc\Controller\Plugin\Redirect',
            'messenger'          => 'WellCart\Mvc\Controller\Plugin\Messenger',
            'flashmessenger'     => 'WellCart\Mvc\Controller\Plugin\FlashMessenger',
            'createPageView'     => 'WellCart\Mvc\Controller\Plugin\CreatePageView',
            'createViewModel'    => 'WellCart\Mvc\Controller\Plugin\CreateViewModel',
            'createConsoleModel' => 'WellCart\Mvc\Controller\Plugin\CreateConsoleModel',
            'createFeedModel'    => 'WellCart\Mvc\Controller\Plugin\CreateFeedModel',
            'createHalJsonModel' => 'WellCart\Mvc\Controller\Plugin\CreateHalJsonModel',
            'createJsonModel'    => 'WellCart\Mvc\Controller\Plugin\CreateJsonModel',
            'invokeAction'       => 'WellCart\Mvc\Controller\Plugin\InvokeAction',
        ],
    ],
    // Placeholder for console routes
    'console'                    => [
        'router' => [
            'routes' => [
                'wellcart:cache:flush' => [
                    'options' => [
                        'route'    => 'wellcart:cache:flush',
                        'defaults' => [
                            'controller' => 'Base::Console\Cache',
                            'action'     => 'flush',
                        ]
                    ]
                ],
                'wellcart:route:list'  => [
                    'options' => [
                        'route'    => 'wellcart:route:list',
                        'defaults' => [
                            'controller' => 'Base::Console\Route',
                            'action'     => 'list',
                        ]
                    ]
                ],
            ],
        ],
    ],
    /**
     * =========================================================
     * Static assets configuration
     * =========================================================
     */
    'asset_manager'              => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ => __DIR__ . '/../public/',
            ],
        ],
    ],
    'ze_theme'                   => [
        'default_theme' => 'wellcart-frontend-ui',
        'adapters'      => [
            'ZeTheme\Adapter\Route' => 'ZeTheme\Adapter\Route',
        ],
    ],
    'php_settings'               => [
        'realpath_cache_size'     => '128K',
        'realpath_cache_ttl'      => 1800,
        'upload_tmp_dir'          => WELLCART_UPLOAD_PATH,
        'file_uploads'            => true,
        'log_errors'              => true,
        'display_errors'          => true,
        'display_startup_errors'  => true,
        'short_open_tag'          => true,
        'memory_limit'            => '255M',
        'max_execution_time'      => 800,
        'max_input_nesting_level' => 64,
        'max_input_vars'          => 500,
        'upload_max_filesize'     => '30M',
        'max_post_size'           => '30M',
        'max_file_uploads'        => 10,
        'error_log'               => WELLCART_STORAGE_PATH . 'logs' . DS
            . 'error.log',
        'session.save_path'       => WELLCART_STORAGE_PATH . 'sessions' . DS,
    ],
    'soflomo_log'                => [
        'writers' => [
            'firephp'                    => [
                'enabled' => true,
            ],
            'chromephp'                  => [
                'enabled' => false,
            ],
            'WellCart\Log\Writer\Stream' => [
                'enabled' => true,
                'stream'  => WELLCART_STORAGE_PATH . 'logs/application.log',
            ],
            'stream'                     => [
                'enabled' => false,
            ],
        ],
    ],
    'log'                        => [
        'log_base'                => [
            'writers' => [
                [
                    'name'     => 'WellCart\Log\Writer\File',
                    'priority' => 1000,
                    'options'  => [
                        'stream' => WELLCART_STORAGE_PATH . 'logs/base.log',
                    ],
                ],
            ],
        ],
        'log_mail_service_errors' => [
            'writers' => [
                [
                    'name'     => 'WellCart\Log\Writer\File',
                    'priority' => 1000,
                    'options'  => [
                        'stream' => WELLCART_STORAGE_PATH
                            . 'logs/mail_service_errors.log',
                    ],
                ],
            ],
        ],
    ],
    'stroker_form'               => [
        'activeRenderers'  => [
            'stroker_form.renderer.jqueryvalidate',
        ],
        'renderer_options' => [
            'stroker_form.renderer.jqueryvalidate' => [
                'options_class'         => 'StrokerForm\Renderer\JqueryValidate\Options',
                'include_assets'        => false,
                'use_twitter_bootstrap' => false,
            ]
        ],
    ],
    'session_containers'         => [
        'BaseSessionContainer' => 'BaseSessionContainer',
        'CsrfSessionContainer' => 'CsrfSessionContainer',
    ],
    'cronModule'                 => [
        'phpPath'    => 'php',
        'scriptPath' => WELLCART_BIN_PATH,
        'jobs'       => [
        ]
    ],
    'route_manager'              => [
        'invokables' => [
            'SkippableSegment' => 'WellCart\Router\Http\SkippableSegment',
        ],
        'factories'  => [
            'SystemUrlRewritesHandler' => 'WellCart\Router\Http\Factory\SystemUrlRewritesFactory',
        ],
    ],
    'form_elements'              => [
        'factories'  => [
            'localeLanguageSelector' => Factory\FormElement\LocaleLanguageSelectorFactory::class,
            'translatableCollection' => Factory\FormElement\TranslatableCollectionFactory::class,
        ],
        'aliases'    => [
            'htmlAnchor'     => FormElement\HtmlAnchor::class,
            'htmlanchor'     => FormElement\HtmlAnchor::class,
            'HtmlAnchor'     => FormElement\HtmlAnchor::class,
            'button'         => FormElement\Button::class,
            'Button'         => FormElement\Button::class,
            'captcha'        => FormElement\Captcha::class,
            'Captcha'        => FormElement\Captcha::class,
            'checkbox'       => FormElement\Checkbox::class,
            'Checkbox'       => FormElement\Checkbox::class,
            'collection'     => FormElement\Collection::class,
            'Collection'     => FormElement\Collection::class,
            'color'          => FormElement\Color::class,
            'Color'          => FormElement\Color::class,
            'csrf'           => FormElement\Csrf::class,
            'Csrf'           => FormElement\Csrf::class,
            'date'           => FormElement\Date::class,
            'Date'           => FormElement\Date::class,
            'dateselect'     => FormElement\DateSelect::class,
            'dateSelect'     => FormElement\DateSelect::class,
            'DateSelect'     => FormElement\DateSelect::class,
            'datetime'       => FormElement\DateTime::class,
            'dateTime'       => FormElement\DateTime::class,
            'DateTime'       => FormElement\DateTime::class,
            'datetimelocal'  => FormElement\DateTimeLocal::class,
            'dateTimeLocal'  => FormElement\DateTimeLocal::class,
            'DateTimeLocal'  => FormElement\DateTimeLocal::class,
            'datetimeselect' => FormElement\DateTimeSelect::class,
            'dateTimeSelect' => FormElement\DateTimeSelect::class,
            'DateTimeSelect' => FormElement\DateTimeSelect::class,
            'email'          => FormElement\Email::class,
            'Email'          => FormElement\Email::class,
            'file'           => FormElement\File::class,
            'File'           => FormElement\File::class,
            'form'           => 'WellCart\Form\Form',
            'Form'           => 'WellCart\Form\Form',
            'hidden'         => FormElement\Hidden::class,
            'Hidden'         => FormElement\Hidden::class,
            'image'          => FormElement\Image::class,
            'Image'          => FormElement\Image::class,
            'month'          => FormElement\Month::class,
            'Month'          => FormElement\Month::class,
            'monthselect'    => FormElement\MonthSelect::class,
            'monthSelect'    => FormElement\MonthSelect::class,
            'MonthSelect'    => FormElement\MonthSelect::class,
            'multicheckbox'  => FormElement\MultiCheckbox::class,
            'multiCheckbox'  => FormElement\MultiCheckbox::class,
            'MultiCheckbox'  => FormElement\MultiCheckbox::class,
            'multiCheckBox'  => FormElement\MultiCheckbox::class,
            'MultiCheckBox'  => FormElement\MultiCheckbox::class,
            'number'         => FormElement\Number::class,
            'Number'         => FormElement\Number::class,
            'password'       => FormElement\Password::class,
            'Password'       => FormElement\Password::class,
            'radio'          => FormElement\Radio::class,
            'Radio'          => FormElement\Radio::class,
            'range'          => FormElement\Range::class,
            'Range'          => FormElement\Range::class,
            'select'         => FormElement\Select::class,
            'Select'         => FormElement\Select::class,
            'submit'         => FormElement\Submit::class,
            'Submit'         => FormElement\Submit::class,
            'text'           => FormElement\Text::class,
            'Text'           => FormElement\Text::class,
            'textarea'       => FormElement\Textarea::class,
            'Textarea'       => FormElement\Textarea::class,
            'time'           => FormElement\Time::class,
            'Time'           => FormElement\Time::class,
            'url'            => FormElement\Url::class,
            'Url'            => FormElement\Url::class,
            'week'           => FormElement\Week::class,
            'Week'           => FormElement\Week::class,
        ],
        'invokables' => [
            'tableFieldsetCollection'  => 'WellCart\Ui\Form\Element\TableFieldsetCollection',
            'static'                   => FormElement\StaticElement::class,
            'yesNoSelector'            => FormElement\YesNoSelector::class,
            'localeSelector'           => FormElement\LocaleSelector::class,
            'baseEmailContactSelector' => FormElement\EmailContactSelector::class,
            'timezoneSelector'         => FormElement\TimezoneSelector::class,
            'countrySelector'          => FormElement\CountrySelector::class,
            'dateRange'                => FormElement\DateRange::class,
            'rangeFilter'              => FormElement\RangeFilter::class,

            FormElement\HtmlAnchor::class     => FormElement\HtmlAnchor::class,
            FormElement\Button::class         => FormElement\Button::class,
            FormElement\Captcha::class        => FormElement\Captcha::class,
            FormElement\Checkbox::class       => FormElement\Checkbox::class,
            FormElement\Collection::class     => FormElement\Collection::class,
            FormElement\Color::class          => FormElement\Color::class,
            FormElement\Csrf::class           => FormElement\Csrf::class,
            FormElement\Date::class           => FormElement\Date::class,
            FormElement\DateSelect::class     => FormElement\DateSelect::class,
            FormElement\DateTime::class       => FormElement\DateTime::class,
            FormElement\DateTimeLocal::class  => FormElement\DateTimeLocal::class,
            FormElement\DateTimeSelect::class => FormElement\DateTimeSelect::class,
            FormElement\Email::class          => FormElement\Email::class,
            FormElement\File::class           => FormElement\File::class,
            'WellCart\Form\Form'              => 'WellCart\Form\Form',
            FormElement\Hidden::class         => FormElement\Hidden::class,
            FormElement\Image::class          => FormElement\Image::class,
            FormElement\Month::class          => FormElement\Month::class,
            FormElement\MonthSelect::class    => FormElement\MonthSelect::class,
            FormElement\MultiCheckbox::class  => FormElement\MultiCheckbox::class,
            FormElement\Number::class         => FormElement\Number::class,
            FormElement\Password::class       => FormElement\Password::class,
            FormElement\Radio::class          => FormElement\Radio::class,
            FormElement\Range::class          => FormElement\Range::class,
            FormElement\Select::class         => FormElement\Select::class,
            FormElement\Submit::class         => FormElement\Submit::class,
            FormElement\Text::class           => FormElement\Text::class,
            FormElement\Textarea::class       => FormElement\Textarea::class,
            FormElement\Time::class           => FormElement\Time::class,
            FormElement\Url::class            => FormElement\Url::class,
            FormElement\Week::class           => FormElement\Week::class,
        ],
    ],
    'form_element_configuration' => [
        'class_map' => [
            'formhtmlanchor'  => 'WellCart\Form\View\Helper\FormHtmlAnchor',
            'formdaterange'   => 'WellCart\Form\View\Helper\FormDateRange',
            'formrangefilter' => 'WellCart\Form\View\Helper\FormRangeFilter',
        ],
        'type_map'  => [
            'htmlanchor'  => 'formhtmlanchor',
            'daterange'   => 'formdaterange',
            'rangefilter' => 'formrangefilter',
        ],
    ],
    'ZfcDatagrid'                => [
        'settings' => [
            'default' => [
                // If no specific renderer given, use this renderer for HTTP / console
                'renderer' => [
                    'http'    => 'bootstrapTable',
                    'console' => 'zendTable',
                ],
            ],
            'export'  => [
                // Export is enabled?
                'enabled' => true,
                'formats' => [],
                // The output+save directory
                'path'    => WELLCART_STORAGE_PATH . 'cache/',
            ],
        ],
        // The cache is used to save the filter + sort and other things for exporting
        'cache'    => [
            'adapter' => [
                'name'    => 'Filesystem',
                'options' => [
                    'ttl'                 => 720000, // cache with 200 hours,
                    'cache_dir'           => WELLCART_STORAGE_PATH . 'cache/',
                    'dir_level'           => 1,
                    'dir_permission'      => 0777,
                    'file_permission'     => 0666,
                    'umask'               => 0,
                    'namespace_separator' => '-datagrid-',
                ],
            ],
        ],
    ],
    'wizard'                     => [
        /**
         * Default layout template of the wizard
         */
        'default_layout_template' => 'wizard/layout',
        /**
         * Default wizard class
         */
        'default_class'           => 'Wizard\Wizard',
        /**
         * Wizard list
         */
        'wizards'                 => [],
    ],
    'wizard_steps'               => [],
    'navigation'                 => [
        'backend_main_navigation' => include __DIR__
            . '/backend_main_navigation.php',
    ],
    'headbuild'                  => [
        'public_path'   => WELLCART_PUBLIC_PATH,
        'manifest_file' => WELLCART_ASSETS_PATH . 'revision-manifest.json'
    ],

    'design' => [
        'images' => [
            'filters'           => [],
            'image_resolvers'   => [],
            'resolvers_manager' => [],
            'loaders'           => [],
        ]
    ],

    'slm_queue' => [
        'queue_manager' => [
            'factories' => [
                'system' => 'SlmQueueDoctrine\Factory\DoctrineQueueFactory'
            ]
        ],
        'queues'        => [
            'system' => [
                'table_name' => 'base_job_queue',
            ],
        ],
        'job_manager'   => [],
    ],
];
