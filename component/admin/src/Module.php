<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin;

use WellCart\Admin\Mvc\Controller\Plugin\Notification as NotificationPlugin;
use WellCart\Admin\View\Helper\Notification as NotificationHelper;
use WellCart\ModuleManager\Feature\DataFixturesProviderInterface;
use WellCart\ModuleManager\Feature\MigrationsProviderInterface;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\Mvc\Application;
use WellCart\Utility\Arr;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature;
use Zend\Mvc\MvcEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements
    Feature\BootstrapListenerInterface,
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    VersionProviderInterface,
    DataFixturesProviderInterface,
    MigrationsProviderInterface,
    Feature\ControllerPluginProviderInterface,
    Feature\ViewHelperProviderInterface,
    ApigilityProviderInterface,
    ModulePathProviderInterface
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
        $target = $e->getTarget();
        $target->getEventManager()->attach(
            $target->getServiceManager()->get(
                'WellCart\Admin\Rbac\View\Strategy\UnauthorizedStrategy'
            )
        );
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array
     */
    public function getConfig()
    {
        $config = include __DIR__ . '/../config/module.config.php';
        if (application_context(Application::CONTEXT_API)) {
            $config = Arr::merge(
                $config,
                include __DIR__ . '/../config/api.config.php'
            );
        }
        return $config;
    }

    /**
     * Provided services
     *
     * @return array
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/../config/services.php';
    }

    /**
     * Retrieve array of migration classes
     *
     * @return \WellCart\SchemaMigration\AbstractMigration[]
     */
    public function getMigrations(): array
    {
        return [
            '20160704000000' => new Setup\Schema\Install(
                '20160704000000'
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
            '20160704000000' => new Setup\Data\Install(
                '20160704000000'
            ),
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
     * Controller plugins
     *
     * @return array
     */
    public function getControllerPluginConfig()
    {
        return [
            'factories' => [
                'admin_notification' => function ($sm) {
                    return new NotificationPlugin(
                        $sm->getServiceLocator()->get('admin\notification')
                    );
                }
            ],
        ];
    }

    /**
     * View helpers
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'admin_notifications' => function ($sm) {
                    $notification = $sm->getServiceLocator()->get(
                        'admin\notification'
                    );
                    return new NotificationHelper(
                        $notification->recentCount(),
                        $notification->recentMessages(5)
                    );
                }
            ],
        ];
    }
}
