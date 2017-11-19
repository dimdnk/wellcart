<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend;

use WellCart\Backend\Rbac\View\Strategy\UnauthorizedStrategy;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\ModuleManager\ModuleConfigProvider;
use WellCart\Setup\Feature\DataFixturesProviderInterface;
use WellCart\Setup\Feature\MigrationsProviderInterface;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;

class Module implements
    Feature\BootstrapListenerInterface,
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    VersionProviderInterface,
    DataFixturesProviderInterface,
    MigrationsProviderInterface,
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

        $app = $e->getParam('application');
        $em  = $app->getEventManager();

        $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'selectLayoutBasedOnRoute'));

        $target->getEventManager()->attach(
            $target->getServiceManager()->get(UnauthorizedStrategy::class)
        );
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array
     */
    public function getConfig()
    {
        return (new ConfigAggregator([new ModuleConfigProvider(__DIR__ . '/../config')]))->getMergedConfig();
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
     * @return \WellCart\Setup\SchemaMigration\AbstractMigration[]
     */
    public function getSetupMigrations(): array
    {
        return [
            '20170904000000' => new Setup\Schema\Install(
                '20170904000000'
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
            '20170904000000' => new Setup\Data\Install(
                '20170904000000'
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
     * Select the admin layout based on route name
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function selectLayoutBasedOnRoute(MvcEvent $e)
    {
        $app    = $e->getParam('application');
        $sm     = $app->getServiceManager();
        $config = $sm->get('config');

        if (false === $config['wellcart']['backend']['use_admin_layout']) {
            return;
        }

        $match      = $e->getRouteMatch();
        $controller = $e->getTarget();
        if (!$match instanceof RouteMatch
            || 0 !== strpos($match->getMatchedRouteName(), 'backend')
            || $controller->getEvent()->getResult()->terminate()
        ) {
            return;
        }

        $layout     = $config['wellcart']['backend']['admin_layout_template'];
        $controller->layout($layout);
    }
}


