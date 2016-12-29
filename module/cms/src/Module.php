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
use WellCart\ModuleManager\Feature\SetupDataFixturesProviderInterface;
use WellCart\ModuleManager\Feature\SetupMigrationsProviderInterface;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\ModuleManager\ModuleConfiguration;
use Zend\Form\Factory as FormFactory;
use Zend\ModuleManager\Feature;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
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
            '20161206000000' => new Setup\Schema\Install(
                '20161206000000'
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
            '20161206000000' => new Setup\Data\Install(
                '20161206000000'
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
        return [
            'factories' => [
                PageView\Backend\PageForm::class  =>
                    function (ContainerInterface $sm) {
                        return new PageView\Backend\PageForm(
                            $sm->get(
                                Spec\PageRepository::class
                            )
                        );
                    },
                PageView\Backend\PagesGrid::class =>
                    function (ContainerInterface $sm) {
                        return new PageView\Backend\PagesGrid(
                            $sm->get(
                                Spec\PageI18nRepository::class
                            )
                        );
                    },
                Repository\Pages::class         =>
                    function (ContainerInterface $sm) {
                        return $sm->get('wellcart_cms_object_manager')
                            ->getRepository(
                                Spec\PageEntity::class
                            );
                    },
                Repository\PageI18n::class      =>
                    function (ContainerInterface $sm) {
                        return $sm->get('wellcart_cms_object_manager')
                            ->getRepository(
                                Spec\PageI18nEntity::class
                            );
                    },
                Form\Page::class                =>
                    function (ContainerInterface $sm) {
                        $pagePrototype = $sm->get(
                            Spec\PageRepository::class
                        )->createEntity();


                        $pageTranslationPrototype = $sm->get(
                            Spec\PageI18nRepository::class
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
