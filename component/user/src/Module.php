<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User;

use WellCart\ModuleManager\Feature\DataFixturesProviderInterface;
use WellCart\ModuleManager\Feature\MigrationsProviderInterface;
use WellCart\ModuleManager\Feature\ModulePathProviderInterface;
use WellCart\ModuleManager\Feature\VersionProviderInterface;
use WellCart\Mvc\Application;
use WellCart\Utility\Arr;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements
    Feature\ConfigProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\BootstrapListenerInterface,
    Feature\FormElementProviderInterface,
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
            '20160702000000' => new Setup\Schema\Install(
                '20160702000000'
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
            '20160702000000' => new Setup\Data\Install(
                '20160702000000'
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
                'userRolesMultiCheckboxSelector'          =>
                    function (\Zend\Form\FormElementManager\FormElementManagerV2Polyfill $sm
                    ) {
                        $services = $sm->getServiceLocator();
                        $roles = $services->get(
                            'WellCart\User\Spec\AclRoleRepository'
                        )
                            ->toOptionsList();
                        return new \WellCart\Form\Element\MultiCheckbox(
                            null,
                            ['value_options' => $roles]
                        );
                    },
                'userAclPermissionsMultiCheckboxSelector' =>
                    function (\Zend\Form\FormElementManager\FormElementManagerV2Polyfill $sm
                    ) {
                        $services = $sm->getServiceLocator();
                        $permissions = $services->get(
                            'WellCart\User\Spec\AclPermissionRepository'
                        )
                            ->toOptionsList();
                        return new \WellCart\Form\Element\MultiCheckbox(
                            null,
                            ['value_options' => $permissions]
                        );
                    },
                'userAccountsSelector'                    =>
                    function (\Zend\Form\FormElementManager\FormElementManagerV2Polyfill $sm
                    ) {
                        $services = $sm->getServiceLocator();
                        $users = $services->get(
                            'WellCart\User\Spec\UserRepository'
                        )
                            ->toOptionsList();
                        return new \WellCart\Form\Element\Select(
                            null,
                            ['value_options' => $users,
                             'empty_option'  => __(
                                 '- Select user account -'
                             ),
                            ]
                        );
                    },
            ]
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
