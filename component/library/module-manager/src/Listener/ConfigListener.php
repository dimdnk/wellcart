<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\ModuleManager\Listener;

use WellCart\ModuleManager\Service\SystemConfigDbReader;
use WellCart\Mvc\Application;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\ModuleManager\Listener\ConfigListener as OriginalConfigListener;
use Zend\ModuleManager\ModuleEvent;

class ConfigListener extends AbstractListenerAggregate
{

    const BASE_CONFIG_CACHE_FILE = 'base-config';

    /**
     * @var bool
     */
    protected $skipConfig = false;

    /**
     * Attach listener to ModuleEvent::EVENT_MERGE_CONFIG
     *
   * @param EventManagerInterface $events
   * @param int                   $priority
   */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            ModuleEvent::EVENT_LOAD_MODULE_RESOLVE, [$this, 'onModuleResolve'],
            999
        );
        $this->listeners[] = $events->attach(
            ModuleEvent::EVENT_MERGE_CONFIG, [$this, 'onMergeConfig'], 500
        );
    }

    public function onModuleResolve(ModuleEvent $e)
    {
        $configListener = $e->getConfigListener();
        if (!$configListener instanceof OriginalConfigListener) {
            return;
        }
        $config = $configListener->getMergedConfig(false);
        if (empty($config)) {
            return;
        }
        $this->skipConfig = true;
        Config::load($config);
    }

    /**
     * Listen to ModuleEvent::EVENT_MERGE_CONFIG
     *
     * @param ModuleEvent $e
     */
    public function onMergeConfig(ModuleEvent $e)
    {
        if ($this->skipConfig) {
            return;
        }
        $configListener = $e->getConfigListener();
        if (!$configListener instanceof OriginalConfigListener) {
            return;
        }

        $env = application_env();
        $context = application_context();
        $host = (string)(php_sapi_name() == "cli")
            ? 'cli'
            : getenv(
                'HTTP_HOST'
            );

        $host = str_replace(':', '', $host);
        $cacheKey = $host . '_' . $env . '_' . $context;

        $config = $configListener->getMergedConfig(false);

        $options = $configListener->getOptions();
        $dbSetConfigPath
            = $options->getCacheDir() . '/' .
            self::BASE_CONFIG_CACHE_FILE . '_' .
            $cacheKey . '.php';

        if ($context != Application::CONTEXT_SETUP) {
            if (!is_file($dbSetConfigPath) && is_dir($options->getCacheDir())
                && is_writable($options->getCacheDir())
            ) {
                $reader = new SystemConfigDbReader();
                $dbSetConfig = $reader->getConfig()->toArray();
                touch($dbSetConfigPath);
                chmod($dbSetConfigPath, 0664);
                file_put_contents(
                    $dbSetConfigPath,
                    "<?php\n// System Configuration file generated from db values\n\nreturn "
                    . var_export_short($dbSetConfig, true) . ';'
                );
            } else {
                $dbSetConfig = include $dbSetConfigPath;
            }

            $config = Arr::merge($config, (array)$dbSetConfig);
        }

        $contextConfig = Arr::get($config, 'context_specific.' . $context, []);
        $config = Arr::merge($config, (array)$contextConfig);
        unset($config['wellcart']['layout']['collectors']['filesystem']);
        // Reset merged config
        $configListener->setMergedConfig($config);
        Config::load($config);
    }
}