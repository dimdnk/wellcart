<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User;

use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\SetupDataFixturesProviderInterface;
use WellCart\ModuleManager\Feature\SetupMigrationsProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\ModuleManager\ModuleConfiguration;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\BootstrapListenerInterface,
    SetupDataFixturesProviderInterface,
    SetupMigrationsProviderInterface,
    ApigilityProviderInterface,
    VersionProviderInterface,
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
     * @param EventInterface $e
     *
     * @return array|void
     */
    public function onBootstrap(EventInterface $e)
    {
        $application = $e->getApplication();
        $eventManager = $application->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        $serviceManager = $application->getServiceManager();
        $rbacListener = $serviceManager->get(
            'WellCart\User\EventListener\Navigation\PageAuthorizationByRbac'
        );

        $sharedEventManager->attach(
            'Zend\View\Helper\Navigation\AbstractHelper',
            'isAllowed',
            [$rbacListener, 'accept']
        );

        $authService = $serviceManager->get(
            'ZfcRbac\Service\AuthorizationService'
        );
        $sharedEventManager
            ->attach(
                'ConLayout\Layout\Layout',
                'isAllowed',
                function ($e) use ($authService) {
                    return true;
                    $resource = $e->getParam('block_id');
                    $e->stopPropagation();
                    return $authService->isGranted($resource);
                }
            );
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return ModuleConfiguration
     */
    public function getConfig()
    {
        return new ModuleConfiguration(__DIR__ . '/../config');
    }

    /**
     * Retrieve array of migration classes
     *
     * @return \WellCart\Setup\SchemaMigration\AbstractMigration[]
     */
    public function getSetupMigrations(): array
    {
        return [
            '20161202000000' => new Setup\Schema\Install(
                '20161202000000'
            ),
        ];
    }

    /**
     * Retrieve array of data fixture classes
     *
     * @return \WellCart\Setup\DataFixture\AbstractFixture[]
     */
    public function getSetupDataFixtures(): array
    {
        return [
            '20161202000000' => new Setup\Data\Install(
                '20161202000000'
            ),
        ];
    }

    /**
     * Services
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/../config/services.php';
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
}
