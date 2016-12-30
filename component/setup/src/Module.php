<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup;

use Interop\Container\ContainerInterface;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\ModuleManager\ModuleConfiguration;
use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature;

class Module implements
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\ConsoleUsageProviderInterface,
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
     * Returns configuration to merge with application configuration
     *
     * @return ModuleConfiguration
     */
    public function getConfig()
    {
        return new ModuleConfiguration(__DIR__ . '/../config');
    }

    /**
     * Services
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'WellCart\Setup\Service\Setup' =>
                    function (ContainerInterface $sm) {
                        return new Service\Setup($sm);
                    },
            ],
        ];
    }

    /**
     * Returns an array or a string containing usage information for this module's Console commands.
     * The method is called with active Zend\Console\Adapter\AdapterInterface that can be used to directly access
     * Console and send output.
     *
     * If the result is a string it will be shown directly in the console window.
     * If the result is an array, its contents will be formatted to console window width. The array must
     * have the following format:
     *
     *     return array(
     *                'Usage information line that should be shown as-is',
     *                'Another line of usage info',
     *
     *                '--parameter'        =>   'A short description of that parameter',
     *                '-another-parameter' =>   'A short description of another parameter',
     *                ...
     *            )
     *
     * @param AdapterInterface $console
     *
     * @return array|string|null
     */
    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            "Installing the WellCart software from the command line:\n",
            'setup [--db-driver=<db-driver>] [--db-host=<db-host>] [--db-port=<db-port>] --db-name=<db-name> --db-username=<db-username> [--db-password=<db-password>] --admin-email=<admin-email> --admin-password=<admin-password> --admin-first-name=<admin-first-name> --admin-last-name=<admin-last-name> --base-path=<base-path> [--website-name=<website-name>]' => '',
            ['--db-driver',
             'Database driver (pdo_mysql, pdo_pgsql).'],
            ['--db-host',
             'The database server\'s fully qualified host name or IP address.'],
            ['--db-port',
             'Database port number.'],
            ['--db-name',
             'Name of the WellCart database instance in which you want to install the WellCart database tables.'],
            ['--db-username',
             'User name of the WellCart database instance owner.'],
            ['--db_password',
             'WellCart database instance owner\'s password.'],
            ['--admin-email',
             'WellCart administrator user\'s e-mail address.'],
            ['--admin-password', 'WellCart administrator user password.'],
            ['--admin-first-name', 'Administrator first name.'],
            ['--admin-last-name', 'Administrator last name.'],
            ['--base-path',
             "Fully qualified URLs that end with '/' (slash) e.g. http://example.com/"],
            ['--website-name', 'Website Name.'],

            "Upgrades the WellCart application, DB data, and schema:\n",
            'setup:upgrade'                                                                                                                                                                                                                                                                                                                                             => '',

            "Publish module's private resource files by creating symlinks to them in the web-visible area:\n",
            'setup:publish-assets'                                                                                                                                                                                                                                                                                                                                      => '',

            'maintenance:status'  => 'Displays maintenance mode status',
            'maintenance:enable'  => 'Enables maintenance mode',
            'maintenance:disable' => 'Disables maintenance mode',
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
}
