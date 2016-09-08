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
use WellCart\Mvc\Application;
use WellCart\Utility\Arr;
use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\FormElementProviderInterface,
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
     * Retrieve array of migration classes
     *
     * @return \WellCart\SchemaMigration\AbstractMigration[]
     */
    public function getMigrations(): array
    {
        return [
            '20160705000000' => new Setup\Schema\Install(
                '20160705000000'
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
            '20160705000000' => new Setup\Data\Install(
                '20160705000000'
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
     * Form elements
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getFormElementConfig()
    {
        return [
            'factories' => [
                'directoryCountrySelector' =>
                    function (\Zend\Form\FormElementManager\FormElementManagerV2Polyfill $sm
                    ) {
                        $countries = $sm->getServiceLocator()->get(
                            'WellCart\Directory\Spec\CountryRepository'
                        );

                        $options = $countries->toOptionsList();
                        $countrySelector = new Form\Element\CountrySelector(
                            null,
                            [],
                            $options
                        );

                        $value = current(array_keys($options));
                        $countrySelector->setValue($value);
                        return $countrySelector;
                    },
                'directoryZoneSelector'    =>
                    function (\Zend\Form\FormElementManager\FormElementManagerV2Polyfill $sm
                    ) {
                        $countries = $sm->getServiceLocator()->get(
                            'WellCart\Directory\Spec\ZoneRepository'
                        );
                        return new Form\Element\ZoneSelector(
                            null,
                            [],
                            $countries
                        );
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
     * @inheritdoc
     */
    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            "Directory enables the management of countries and regions associated data like the country code and currency rates. Also, enables conversion of prices to a specified currency format.:\n",
            'wellcart:directory:update-currency-rates' => 'Import currency rates from Yahoo Finance service.',
        ];
    }
}
