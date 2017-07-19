<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Mvc\Factory;

use Interop\Container\ContainerInterface;
use WellCart\Mvc\Application;
use WellCart\Utility\Arr;
use Zend\Mvc\Service\ModuleManagerFactory as AbstractFactory;
use Zend\Stdlib\PriorityList;

class ModuleManagerFactory extends AbstractFactory
{

    /**
     * Packages installed by Composer
     *
     * @var string
     */
    protected $installed = "composer/installed.json";

    /**
     * The 'composer.json' data.
     *
     * @var string
     */
    protected $composer = "composer.json";


    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container, $name,
        array $options = null
    ) {
        if (!$container->has('ServiceListener')) {
            $container->setFactory(
                'ServiceListener',
                'Zend\Mvc\Service\ServiceListenerFactory'
            );
        }

        $configuration = $container->get('ApplicationConfig');
        $modules = $this->composeModules((array)$configuration['modules']);

        $container->setAllowOverride(true);
        $configuration['modules'] = $modules;
        $container->setService('ApplicationConfig', $configuration);
        $container->setAllowOverride(false);

        return parent::__invoke(
            $container,
            $name,
            $options
        );
    }

    /**
     * Compose modules list from installed.json
     *
     * @param array $defaultModules
     *
     * @return array
     */
    protected function composeModules(array $defaultModules)
    {
        $modules = $parentModules = $subParentModules = [];
        $contextInfo = $this->buildContextInfo();
        $appContext = application_context();
        if (!isset($contextInfo[$appContext])) {
            return $defaultModules;
        }

        $currentContextData = $contextInfo[$appContext];
        if ($appContext != Application::CONTEXT_GLOBAL) {
            $context = $currentContextData;
            $contextModules = $context['require'];
            $extends = $context['extends'];
            if ($extends) {
                $parentModules = (array)$contextInfo[$extends]['require'];
                if ($contextInfo[$extends]['extends']) {
                    $parentExtends = $contextInfo[$extends]['extends'];
                    $subParentModules
                        = (array)$contextInfo[$parentExtends]['require'];
                }
            }

            $modules = Arr::merge($modules, $subParentModules);
            $modules = Arr::merge($modules, $parentModules);
            $modules = Arr::merge($modules, $contextModules);
            $modules = Arr::merge($modules, $defaultModules);
        } else {
            foreach ($contextInfo as $code => $context) {
                if (!empty($context['require'])) {
                    $modules = Arr::merge($modules, $context['require']);
                }
            }
            $modules = Arr::merge($modules, $defaultModules);
        }
        $queue = new PriorityList();
        $queue->isLIFO(false);
        foreach ($modules as $module)
        {
          $queue->insert($module['name'], $module['name'],  $module['priority']);
        }
        $modules = array_unique(array_reverse($queue->toArray()));
        foreach ($currentContextData['exclude'] as $excludeModule) {
            $excludeModule = $excludeModule['name'];
            $idx = array_search($excludeModule, $modules);
            if ($idx !== false) {
                unset($modules[$idx]);
            }
        }
        return $modules;
    }

    protected function buildContextInfo()
    {
        $contextInfo = [];
        $installed = $this->readFile(WELLCART_VENDOR_PATH . $this->installed);
        $composer = [$this->readFile(
            WELLCART_VENDOR_PATH . '../' . $this->composer
        )];
        $files = [
            $installed,
            $composer,
        ];

        foreach ($files as $file) {
            foreach ($file as $spec) {
                if (empty($spec['extra']['wellcart']['context'])
                ) {
                    continue;
                }
                $ctxData = $spec['extra']['wellcart']['context'];
                foreach ($ctxData as $contextName => $contextData) {
                    if (!isset($contextInfo[$contextName])) {
                        $contextInfo[$contextName] = [
                            'name'    => $contextName,
                            'extends' => false,
                            'require' => [],
                            'exclude' => [],
                        ];
                    }

                    if (!empty($contextData['extends'])
                        && $contextInfo[$contextName]['extends'] === false
                    ) {
                        $contextInfo[$contextName]['extends']
                            = (string)$contextData['extends'];
                    }
                    if (!empty($contextData['require'])) {
                        $contextInfo[$contextName]['require'] = Arr::merge(
                            $contextInfo[$contextName]['require'],
                            (array)$contextData['require']
                        );
                    }
                    if (!empty($contextData['exclude'])) {
                        $contextInfo[$contextName]['exclude'] = Arr::merge(
                            $contextInfo[$contextName]['exclude'],
                            (array)$contextData['exclude']
                        );
                    }
                }
            }
        }

        return $contextInfo;
    }

    /**
     * Reads a JSON file and returns the decoded data.
     *
     * @param string $file The `.json` file to read and decode.
     *
     * @return mixed
     *
     */
    protected function readFile($file)
    {
        return json_decode(file_get_contents($file), true);
    }
}
