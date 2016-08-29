<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'wellcart'                   => [
        'website'              => [
            'name' => 'Demo Application',
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
    'service_manager'            => [
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
            'Doctrine\DBAL\Logging\DebugStack'                         => 'Doctrine\DBAL\Logging\DebugStack',
            'WellCart\Base\Service\Cache\Flusher'                      => 'WellCart\Base\Service\Cache\Flusher',
            'WellCart\Base\EventListener\SetupRouterBaseUrl'           => 'WellCart\Base\EventListener\SetupRouterBaseUrl',
            'WellCart\Base\EventListener\SetupPageVariables'           => 'WellCart\Base\EventListener\SetupPageVariables',
            'WellCart\Base\EventListener\InitTheme'                    => 'WellCart\Base\EventListener\InitTheme',
            'WellCart\Base\EventListener\LogException'                 => 'WellCart\Base\EventListener\LogException',
            'WellCart\Base\EventListener\NormalizeViewManagerBasePath' => 'WellCart\Base\EventListener\NormalizeViewManagerBasePath',
            'WellCart\Base\EventListener\DoctrineGlobalCacheChanger'   => 'WellCart\Base\EventListener\DoctrineGlobalCacheChanger',
            'WellCart\Base\EventListener\PrepareLayoutItemView'        => 'WellCart\Base\EventListener\PrepareLayoutItemView',
            'WellCart\Base\ItemView\Text'                              => 'WellCart\Base\ItemView\Text',
            'WellCart\Base\ItemView\HtmlNotices'                       => 'WellCart\Base\ItemView\HtmlNotices',
            'WellCart\Base\ItemView\Notifications'                     => 'WellCart\Base\ItemView\Notifications',
            'WellCart\Base\ItemView\FlashNotifications'                => 'WellCart\Base\ItemView\FlashNotifications',
            'WellCart\Base\ItemView\HtmlFooter'                        => 'WellCart\Base\ItemView\HtmlFooter',
            'WellCart\Base\ItemView\Copyright'                         => 'WellCart\Base\ItemView\Copyright',
            'Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy'    => 'Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy',
            'StandardItemView'                                         => 'WellCart\Ui\Container\ItemView\ItemView',
            'StandardPageView'                                         => 'WellCart\Ui\Container\PageView\PageView',
            'RootView'                                                 => 'WellCart\Ui\Container\LayoutView\Root',
            'StandardLayoutView'                                       => 'WellCart\Ui\Container\LayoutView\LayoutView',
            'StandardViewModel'                                        => 'WellCart\View\Model\ViewModel',
            'StandardConsoleModel'                                     => 'WellCart\View\Model\ConsoleModel',
            'StandardFeedModel'                                        => 'WellCart\View\Model\FeedModel',
            'StandardHalJsonModel'                                     => 'WellCart\View\Model\HalJsonModel',
            'StandardJsonModel'                                        => 'WellCart\View\Model\JsonModel',
            'WellCart\ORM\Repository\RepositoryFactory'                => 'WellCart\ORM\Repository\RepositoryFactory',
            'WellCart\ORM\Mapping\EntityListenerResolver'              => 'WellCart\ORM\Mapping\EntityListenerResolver',
        ],
        'aliases'            => [
            'translator'                                  => 'MvcTranslator',
            'UnderscoreNamingStrategy'                    => 'Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy',
            'wellcart_base_db_adapter'                    => 'Zend\Db\Adapter\Adapter',
            'wellcart_base_object_manager'                => 'Doctrine\ORM\EntityManager',
            'wellcart_base_doctrine_hydrator'             => 'doctrine_hydrator',
            'WellCart\Base\Spec\ConfigurationRepository'  => 'WellCart\Base\Repository\Configuration',
            'WellCart\Base\Spec\UrlRewriteRepository'     => 'WellCart\Base\Repository\UrlRewrites',
            'WellCart\Base\Spec\LocaleLanguageRepository' => 'WellCart\Base\Repository\Locale\Languages',
            'WellCart\Base\Spec\JobQueueRepository'       => 'WellCart\Base\Repository\Queue\Jobs',
        ],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            'WellCart\Base\ItemView\HtmlNotices'           => false,
            'WellCart\Base\ItemView\Notifications'         => false,
            'WellCart\Base\ItemView\FlashNotifications'    => false,
            'WellCart\Base\ItemView\HtmlFooter'            => false,
            'WellCart\Base\ItemView\Copyright'             => false,
            'WellCart\Base\PageView\Admin\LanguagesGrid'   => false,
            'WellCart\Base\PageView\Admin\LanguageForm'    => false,
            'WellCart\Base\PageView\Admin\UrlRewritesGrid' => false,
            'WellCart\Base\PageView\Admin\UrlRewriteForm'  => false,
            'WellCart\Base\ItemView\Text'                  => false,
            'StandardItemView'                             => false,
            'StandardPageView'                             => false,
            'RootView'                                     => true,
            'StandardLayoutView'                           => false,
            'StandardViewModel'                            => false,
            'StandardConsoleModel'                         => false,
            'StandardFeedModel'                            => false,
            'StandardHalJsonModel'                         => false,
            'StandardJsonModel'                            => false,
            'ZfcDatagrid\Datagrid'                         => false,
        ],
    ],

    'db'                         => [
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
    'listeners'                  => [
        'WellCart\Ui\Layout\Listener\AreaBasedOnThemeContext'        => 'WellCart\Ui\Layout\Listener\AreaBasedOnThemeContext',
        'WellCart\Ui\Layout\Listener\ActionHandlesListener'          => 'WellCart\Ui\Layout\Listener\ActionHandlesListener',
        'WellCart\Ui\Layout\Listener\LoadLayoutListener'             => 'WellCart\Ui\Layout\Listener\LoadLayoutListener',
        'WellCart\Ui\Layout\Listener\PrepareActionViewModelListener' => 'WellCart\Ui\Layout\Listener\PrepareActionViewModelListener',

        'WellCart\Base\EventListener\SetLayoutViewModel'             => 'WellCart\Base\EventListener\SetLayoutViewModel',
        'WellCart\Base\EventListener\SetupRouterBaseUrl'             => 'WellCart\Base\EventListener\SetupRouterBaseUrl',
        'WellCart\Base\EventListener\SetupPageVariables'             => 'WellCart\Base\EventListener\SetupPageVariables',
        'WellCart\Base\EventListener\InitTheme'                      => 'WellCart\Base\EventListener\InitTheme',
        'WellCart\Base\EventListener\LogException'                   => 'WellCart\Base\EventListener\LogException',
    ],
    'event_manager'              => include __DIR__
        . '/section/event_manager.php',

    'input_filters'              => [
        'abstract_factories' => [
            'WellCart\InputFilter\InputFilterAbstractServiceFactory' => 'WellCart\InputFilter\InputFilterAbstractServiceFactory',
        ],
    ],

    /**
     * =========================================================
     * Cache manager configuration
     * =========================================================
     */
    'caches'                     => [
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
    'acmailer_options'           => include __DIR__
        . '/section/acmailer_options.php',
    'system_config_editor'       => include __DIR__
        . '/section/system_config_editor.php',

    /**
     * Session configuration
     */
    'session'                    => include __DIR__ . '/section/session.php',

    /**
     * =========================================================
     * Object mapping configuration
     * =========================================================
     */
    'object_mapping'             => include __DIR__
        . '/section/object_mapping.php',

    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'                   => include __DIR__ . '/section/doctrine.php',

    'doctrine_factories'         => [
        'sql_logger_collector' => 'WellCart\ORM\SQLLoggerCollectorFactory',
    ],

    'doctrineviewer'             => [
        /**
         *  Doctrine object manager name
         */
        'object_manager_name' => 'doctrine.entitymanager.orm_default',
    ],
    'rdn_require_js'             => include __DIR__
        . '/section/rdn_require_js.php',

    /**
     * =========================================================
     * Translator configuration
     * =========================================================
     */
    'translator'                 => include __DIR__ . '/section/translator.php',

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'                     =>
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
    'view_manager'               => include __DIR__
        . '/section/view_manager.php',
    'zenddevelopertools'         => include __DIR__
        . '/section/zenddevelopertools.php',
    'view_helper_config'         => [],

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
        'invokables' => [
            'WellCart\Base\Controller\Console\Cache'                => 'WellCart\Base\Controller\Console\CacheController',
            'WellCart\Base\Controller\Console\Ember\ModelGenerator' => 'WellCart\Base\Controller\Console\Ember\ModelGeneratorController',
        ],
        'factories'  => array(
            'TckImageResizer\Controller\Index' => 'WellCart\Base\Factory\Controller\ImageResizeControllerFactory',
        ),
    ],
    /**
     * =========================================================
     * View helper manager configuration
     * =========================================================
     */
    'view_helpers'               => [
        'factories'  => [
            'messenger'   => 'WellCart\View\Helper\Service\MessengerFactory',
            'formElement' => 'WellCart\Form\View\Helper\Service\FormElementFactory',
        ],
        'invokables' => [
            'assetPath'             => 'WellCart\View\Helper\AssetPath',
            'mediaPath'             => 'WellCart\View\Helper\MediaPath',
            'themePath'             => 'WellCart\View\Helper\ThemePath',
            'resizeImage'           => 'WellCart\View\Helper\ResizeImage',
            'headLink'              => 'WellCart\View\Helper\HeadLink',
            'headScript'            => 'WellCart\View\Helper\HeadScript',
            'inlineScript'          => 'WellCart\View\Helper\InlineScript',
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
            'javaScriptEnvironment' => 'WellCart\View\Helper\JavaScriptEnvironment',
            'formRenderer'          => 'WellCart\Form\View\Helper\FormRenderer',
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
        'aliases'    => [],
        'factories'  => [],
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
                'wellcart:dev:generate-ember-models' => [
                    'options' => [
                        'route'    => 'wellcart:dev:generate-ember-models',
                        'defaults' => [
                            'controller' => 'WellCart\Base\Controller\Console\Ember\ModelGenerator',
                            'action'     => 'generate',
                        ]
                    ]
                ],
                'wellcart:cache:flush'               => [
                    'options' => [
                        'route'    => 'wellcart:cache:flush',
                        'defaults' => [
                            'controller' => 'WellCart\Base\Controller\Console\Cache',
                            'action'     => 'flush',
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
        'aliases'    => [
            'button'         => 'WellCart\Form\Element\Button',
            'Button'         => 'WellCart\Form\Element\Button',
            'captcha'        => 'WellCart\Form\Element\Captcha',
            'Captcha'        => 'WellCart\Form\Element\Captcha',
            'checkbox'       => 'WellCart\Form\Element\Checkbox',
            'Checkbox'       => 'WellCart\Form\Element\Checkbox',
            'collection'     => 'WellCart\Form\Element\Collection',
            'Collection'     => 'WellCart\Form\Element\Collection',
            'color'          => 'WellCart\Form\Element\Color',
            'Color'          => 'WellCart\Form\Element\Color',
            'csrf'           => 'WellCart\Form\Element\Csrf',
            'Csrf'           => 'WellCart\Form\Element\Csrf',
            'date'           => 'WellCart\Form\Element\Date',
            'Date'           => 'WellCart\Form\Element\Date',
            'dateselect'     => 'WellCart\Form\Element\DateSelect',
            'dateSelect'     => 'WellCart\Form\Element\DateSelect',
            'DateSelect'     => 'WellCart\Form\Element\DateSelect',
            'datetime'       => 'WellCart\Form\Element\DateTime',
            'dateTime'       => 'WellCart\Form\Element\DateTime',
            'DateTime'       => 'WellCart\Form\Element\DateTime',
            'datetimelocal'  => 'WellCart\Form\Element\DateTimeLocal',
            'dateTimeLocal'  => 'WellCart\Form\Element\DateTimeLocal',
            'DateTimeLocal'  => 'WellCart\Form\Element\DateTimeLocal',
            'datetimeselect' => 'WellCart\Form\Element\DateTimeSelect',
            'dateTimeSelect' => 'WellCart\Form\Element\DateTimeSelect',
            'DateTimeSelect' => 'WellCart\Form\Element\DateTimeSelect',
            'email'          => 'WellCart\Form\Element\Email',
            'Email'          => 'WellCart\Form\Element\Email',
            'file'           => 'WellCart\Form\Element\File',
            'File'           => 'WellCart\Form\Element\File',
            'form'           => 'WellCart\Form\Form',
            'Form'           => 'WellCart\Form\Form',
            'hidden'         => 'WellCart\Form\Element\Hidden',
            'Hidden'         => 'WellCart\Form\Element\Hidden',
            'image'          => 'WellCart\Form\Element\Image',
            'Image'          => 'WellCart\Form\Element\Image',
            'month'          => 'WellCart\Form\Element\Month',
            'Month'          => 'WellCart\Form\Element\Month',
            'monthselect'    => 'WellCart\Form\Element\MonthSelect',
            'monthSelect'    => 'WellCart\Form\Element\MonthSelect',
            'MonthSelect'    => 'WellCart\Form\Element\MonthSelect',
            'multicheckbox'  => 'WellCart\Form\Element\MultiCheckbox',
            'multiCheckbox'  => 'WellCart\Form\Element\MultiCheckbox',
            'MultiCheckbox'  => 'WellCart\Form\Element\MultiCheckbox',
            'multiCheckBox'  => 'WellCart\Form\Element\MultiCheckbox',
            'MultiCheckBox'  => 'WellCart\Form\Element\MultiCheckbox',
            'number'         => 'WellCart\Form\Element\Number',
            'Number'         => 'WellCart\Form\Element\Number',
            'password'       => 'WellCart\Form\Element\Password',
            'Password'       => 'WellCart\Form\Element\Password',
            'radio'          => 'WellCart\Form\Element\Radio',
            'Radio'          => 'WellCart\Form\Element\Radio',
            'range'          => 'WellCart\Form\Element\Range',
            'Range'          => 'WellCart\Form\Element\Range',
            'select'         => 'WellCart\Form\Element\Select',
            'Select'         => 'WellCart\Form\Element\Select',
            'submit'         => 'WellCart\Form\Element\Submit',
            'Submit'         => 'WellCart\Form\Element\Submit',
            'text'           => 'WellCart\Form\Element\Text',
            'Text'           => 'WellCart\Form\Element\Text',
            'textarea'       => 'WellCart\Form\Element\Textarea',
            'Textarea'       => 'WellCart\Form\Element\Textarea',
            'time'           => 'WellCart\Form\Element\Time',
            'Time'           => 'WellCart\Form\Element\Time',
            'url'            => 'WellCart\Form\Element\Url',
            'Url'            => 'WellCart\Form\Element\Url',
            'week'           => 'WellCart\Form\Element\Week',
            'Week'           => 'WellCart\Form\Element\Week',
        ],
        'invokables' => [
            'tableFieldsetCollection'              => 'WellCart\Ui\Form\Element\TableFieldsetCollection',
            'static'                               => 'WellCart\Form\Element\StaticElement',
            'yesNoSelector'                        => 'WellCart\Form\Element\YesNoSelector',
            'localeSelector'                       => 'WellCart\Form\Element\LocaleSelector',
            'baseEmailContactSelector'             => 'WellCart\Form\Element\EmailContactSelector',
            'timezoneSelector'                     => 'WellCart\Form\Element\TimezoneSelector',
            'countrySelector'                      => 'WellCart\Form\Element\CountrySelector',
            'dateRange'                            => 'WellCart\Form\Element\DateRange',
            'rangeFilter'                          => 'WellCart\Form\Element\RangeFilter',


            'WellCart\Form\Element\Button'         => 'WellCart\Form\Element\Button',
            'WellCart\Form\Element\Captcha'        => 'WellCart\Form\Element\Captcha',
            'WellCart\Form\Element\Checkbox'       => 'WellCart\Form\Element\Checkbox',
            'WellCart\Form\Element\Collection'     => 'WellCart\Form\Element\Collection',
            'WellCart\Form\Element\Color'          => 'WellCart\Form\Element\Color',
            'WellCart\Form\Element\Csrf'           => 'WellCart\Form\Element\Csrf',
            'WellCart\Form\Element\Date'           => 'WellCart\Form\Element\Date',
            'WellCart\Form\Element\DateSelect'     => 'WellCart\Form\Element\DateSelect',
            'WellCart\Form\Element\DateTime'       => 'WellCart\Form\Element\DateTime',
            'WellCart\Form\Element\DateTimeLocal'  => 'WellCart\Form\Element\DateTimeLocal',
            'WellCart\Form\Element\DateTimeSelect' => 'WellCart\Form\Element\DateTimeSelect',
            'WellCart\Form\Element\Email'          => 'WellCart\Form\Element\Email',
            'WellCart\Form\Element\File'           => 'WellCart\Form\Element\File',
            'WellCart\Form\Form'                   => 'WellCart\Form\Form',
            'WellCart\Form\Element\Hidden'         => 'WellCart\Form\Element\Hidden',
            'WellCart\Form\Element\Image'          => 'WellCart\Form\Element\Image',
            'WellCart\Form\Element\Month'          => 'WellCart\Form\Element\Month',
            'WellCart\Form\Element\MonthSelect'    => 'WellCart\Form\Element\MonthSelect',
            'WellCart\Form\Element\MultiCheckbox'  => 'WellCart\Form\Element\MultiCheckbox',
            'WellCart\Form\Element\Number'         => 'WellCart\Form\Element\Number',
            'WellCart\Form\Element\Password'       => 'WellCart\Form\Element\Password',
            'WellCart\Form\Element\Radio'          => 'WellCart\Form\Element\Radio',
            'WellCart\Form\Element\Range'          => 'WellCart\Form\Element\Range',
            'WellCart\Form\Element\Select'         => 'WellCart\Form\Element\Select',
            'WellCart\Form\Element\Submit'         => 'WellCart\Form\Element\Submit',
            'WellCart\Form\Element\Text'           => 'WellCart\Form\Element\Text',
            'WellCart\Form\Element\Textarea'       => 'WellCart\Form\Element\Textarea',
            'WellCart\Form\Element\Time'           => 'WellCart\Form\Element\Time',
            'WellCart\Form\Element\Url'            => 'WellCart\Form\Element\Url',
            'WellCart\Form\Element\Week'           => 'WellCart\Form\Element\Week',
        ],
    ],
    'form_element_configuration' => [
        'class_map' => [
            'formdaterange'   => 'WellCart\Form\View\Helper\FormDateRange',
            'formrangefilter' => 'WellCart\Form\View\Helper\FormRangeFilter',
        ],
        'type_map'  => [
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

    'design'                     => [
        'images' => [
            'filters'           => [],
            'image_resolvers'   => [],
            'resolvers_manager' => [],
            'loaders'           => [],
        ]
    ],

    'slm_queue'                  => [
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
