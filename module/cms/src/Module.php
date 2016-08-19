<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS;

use Interop\Container\ContainerInterface;
use WellCart\ModuleManager\Feature\DataFixturesProviderInterface;
use WellCart\ModuleManager\Feature\MigrationsProviderInterface;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\Mvc\Application;
use WellCart\Utility\Arr;
use Zend\Form\Factory as FormFactory;
use Zend\ModuleManager\Feature;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\ControllerProviderInterface,
    DataFixturesProviderInterface,
    MigrationsProviderInterface,
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
            '20160706000000' => new Setup\Schema\Install(
                '20160706000000'
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
            '20160706000000' => new Setup\Data\Install(
                '20160706000000'
            ),
        ];
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
     * Services
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'WellCart\CMS\PageView\Admin\PageForm'  =>
                    function (ContainerInterface $sm) {
                        return new PageView\Admin\PageForm(
                            $sm->get(
                                'WellCart\CMS\Spec\PageRepository'
                            )
                        );
                    },
                'WellCart\CMS\PageView\Admin\PagesGrid' =>
                    function (ContainerInterface $sm) {
                        return new PageView\Admin\PagesGrid(
                            $sm->get(
                                'WellCart\CMS\Spec\PageI18nRepository'
                            )
                        );
                    },
                'WellCart\CMS\Repository\Pages'         =>
                    function (ContainerInterface $sm) {
                        return $sm->get('wellcart_cms_object_manager')
                            ->getRepository(
                                'WellCart\CMS\Spec\PageEntity'
                            );
                    },
                'WellCart\CMS\Repository\PageI18n'      =>
                    function (ContainerInterface $sm) {
                        return $sm->get('wellcart_cms_object_manager')
                            ->getRepository(
                                'WellCart\CMS\Spec\PageI18nEntity'
                            );
                    },
                'WellCart\CMS\Form\Page'                =>
                    function (ContainerInterface $sm) {
                        $pagePrototype = $sm->get(
                            'WellCart\CMS\Spec\PageRepository'
                        )->createEntity();


                        $pageTranslationPrototype = $sm->get(
                            'WellCart\CMS\Spec\PageI18nRepository'
                        )->createEntity();

                        $form = new Form\Page(
                            new FormFactory($sm->get('FormElementManager')),
                            $sm->get('wellcart_cms_doctrine_hydrator'),
                            $pagePrototype,
                            $pageTranslationPrototype
                        );
                        return $form;
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
}
