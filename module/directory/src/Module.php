<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory;

use WellCart\ModuleManager\Feature\DataFixturesProviderInterface;
use WellCart\ModuleManager\Feature\MigrationsProviderInterface;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\ModuleManager\ModuleConfiguration;
use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\ConsoleUsageProviderInterface,
    VersionProviderInterface,
    DataFixturesProviderInterface,
    MigrationsProviderInterface,
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
     * @return \WellCart\Setup\SchemaMigration\AbstractMigration[]
     */
    public function getMigrations(): array
    {
        return [
            '20161005000000' => new Setup\Schema\Install(
                '20161005000000'
            ),
        ];
    }

    /**
     * Retrieve array of data fixture classes
     *
     * @return \WellCart\Setup\DataFixture\AbstractFixture[]
     */
    public function getDataFixtures(): array
    {
        return [
            '20161005000000' => new Setup\Data\Install(
                '20161005000000'
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
