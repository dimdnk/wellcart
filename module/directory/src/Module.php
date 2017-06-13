<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory;

use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\ModuleManager\ModuleConfigProvider;
use WellCart\Setup\Feature\DataFixturesProviderInterface;
use WellCart\Setup\Feature\MigrationsProviderInterface;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature;

class Module implements
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\ConsoleUsageProviderInterface,
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
     * Returns configuration to merge with application configuration
     *
     * @return array
     */
    public function getConfig()
    {
      return (new ConfigAggregator([new ModuleConfigProvider(__DIR__ . '/../config')]))->getMergedConfig();
    }

    /**
     * Retrieve array of migration classes
     *
     * @return \WellCart\Setup\SchemaMigration\AbstractMigration[]
     */
    public function getSetupMigrations(): array
    {
        return [
            '20170605000000' => new Setup\Schema\Install(
                '20170605000000'
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
            '20170605000000' => new Setup\Data\Install(
                '20170605000000'
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

    /**
     * @inheritdoc
     */
    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            "Directory enables the management of countries and regions associated data like the country code and currency rates. Also, enables conversion of prices to a specified currency format.:\n",
            'directory:update-currency-rates' => 'Import currency rates from Yahoo Finance service.',
        ];
    }
}
