<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


namespace WellCart\Utility;

/**
 * Config.
 */
abstract class Config
{
    /**
     * Config array.
     *
     * @var array
     */
    protected static $config = [];

    /**
     * Returns config value or entire config array from a file.
     *
     * @param   string $key     Config key
     * @param   mixed  $default (optional) Default value to return if config value doesn't exist
     *
     * @return  mixed
     */
    public static function get($key, $default = null)
    {
        return Arr::get(static::$config, $key, $default);
    }

    /**
     * Sets a config value.
     *
     * @param   string $key   Config key
     * @param   mixed  $value Config value
     */
    public static function set($key, $value)
    {
        Arr::set(static::$config, $key, $value);
    }

    /**
     * Deletes a value from the configuration.
     *
     * @param   string $key Config key
     *
     * @return  bool
     */
    public static function delete($key): bool
    {
        return Arr::delete(static::$config, $key);
    }

    /**
     * Loads the configuration values.
     *
     * @param array $config
     *
     * @return  array
     */
    public static function load(array $config): array
    {
        static::$config = $config;
        return $config;
    }

    /**
     * Marge configuration values.
     *
     * @param array $config
     *
     * @return  array
     */
    public static function merge(array $config): array
    {
        return Arr::merge(static::$config, $config);
    }

    /**
     * Merges internal arrays with those passed via configuration
     *
     * @param array $configuration
     *
     * @return array
     */
    public static function application(array $configuration = []): array
    {
        $defaults = array(
            // This should be an array of module namespaces used in the application.
            'modules'                  => [],

            // These are various options for the listeners attached to the ModuleManager
            'module_listener_options'  => array(
                // This should be an array of paths in which modules reside.
                // If a string key is provided, the listener will consider that a module
                // namespace, the value of that key the specific path to that module's
                // Module class.
                'module_paths'             => array(
                    './module',
                ),

                // An array of paths from which to glob configuration files after
                // modules are loaded. These effectively override configuration
                // provided by modules themselves. Paths may use GLOB_BRACE notation.
                'config_glob_paths'        => array(
                    'config/autoload/{,*.}{global,local}.php',
                ),

                // Whether or not to enable a configuration cache.
                // If enabled, the merged configuration will be cached and used in
                // subsequent requests.
                'config_cache_enabled'     => false,

                // The key used to create the configuration cache file name.
                'config_cache_key'         =>
                    $_ENV['WELLCART_APPLICATION_ENV'] . '_'
                    . $_ENV['WELLCART_APPLICATION_CONTEXT'],

                // Whether or not to enable a module class map cache.
                // If enabled, creates a module class map cache which will be used
                // by in future requests, to reduce the autoloading process.
                'module_map_cache_enabled' => false,

                // The key used to create the class map cache file name.
                'module_map_cache_key'     =>
                    $_ENV['WELLCART_APPLICATION_ENV'] . '_'
                    . $_ENV['WELLCART_APPLICATION_CONTEXT'],

                // The path in which to cache merged configuration.
                'cache_dir'                => getenv('WELLCART_STORAGE_PATH')
                    . 'cache/',

                // Whether or not to enable modules dependency checking.
                // Enabled by default, prevents usage of modules that depend on other modules
                // that weren't loaded.
                'check_dependencies'       => false,
            ),

            // Used to create an own service manager. May contain one or more child arrays.
            'service_listener_options' =>
                [
                    //     array(
                    //         'service_manager' => $stringServiceManagerName,
                    //         'config_key'      => $stringConfigKey,
                    //         'interface'       => $stringOptionalInterface,
                    //         'method'          => $stringRequiredMethodName,
                    //     ),
                ],

            // Initial configuration with which to seed the ServiceManager.
            // Should be compatible with Zend\ServiceManager\Config.
            //
            'service_manager'          =>
                [
                    'factories' => [
                        'ModuleManager' => 'WellCart\Mvc\Factory\ModuleManagerFactory',
                    ]
                ],
        );

        return Arr::merge($defaults, $configuration);
    }
}