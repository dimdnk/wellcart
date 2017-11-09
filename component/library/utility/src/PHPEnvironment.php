<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use Locale;
use Patchwork\Utf8\Bootup;

/**
 * PHP Environment initializer
 *
 * @codeCoverageIgnore
 */
abstract class PHPEnvironment
{

    /**
     * Initialize PHP environment
     *
     * @return bool
     */
    public static function initialize()
    {
        defined('REQUEST_MICROTIME')
        || define(
            'REQUEST_MICROTIME', microtime(
                true
            )
        );
        putenv('REQUEST_MICROTIME=' . REQUEST_MICROTIME);

        defined('DS') || define('DS', '/');
        defined('PS') || define('PS', PATH_SEPARATOR);
        defined('TIME_NOW') || define('TIME_NOW', time());
        putenv('TIME_NOW=' . TIME_NOW);

        defined('CURLOPT_TIMEOUT_MS') || define('CURLOPT_TIMEOUT_MS', 155);
        defined('CURLOPT_CONNECTTIMEOUT_MS')
        || define('CURLOPT_CONNECTTIMEOUT_MS', 156);

        defined('WELLCART_ROOT') || define('WELLCART_ROOT', getcwd() . '/');
        putenv('WELLCART_ROOT=' . WELLCART_ROOT);

        defined('WELLCART_BIN_PATH')
        || define('WELLCART_BIN_PATH', WELLCART_ROOT . 'bin/');
        putenv('WELLCART_BIN_PATH=' . WELLCART_BIN_PATH);

        defined('WELLCART_STORAGE_PATH')
        || define('WELLCART_STORAGE_PATH', WELLCART_ROOT . 'data/');
        putenv('WELLCART_STORAGE_PATH=' . WELLCART_STORAGE_PATH);

        defined('WELLCART_UPLOAD_PATH')
        || define(
            'WELLCART_UPLOAD_PATH', WELLCART_STORAGE_PATH . 'upload' . DS
        );
        putenv('WELLCART_UPLOAD_PATH=' . WELLCART_UPLOAD_PATH);

        defined('WELLCART_PUBLIC_PATH')
        || define('WELLCART_PUBLIC_PATH', WELLCART_ROOT . 'public/');
        putenv('WELLCART_PUBLIC_PATH=' . WELLCART_PUBLIC_PATH);

        defined('WELLCART_ASSETS_PATH')
        || define('WELLCART_ASSETS_PATH', WELLCART_PUBLIC_PATH . 'assets/');
        putenv('WELLCART_ASSETS_PATH=' . WELLCART_ASSETS_PATH);

        defined('WELLCART_THEMES_PATH')
        || define('WELLCART_THEMES_PATH', WELLCART_PUBLIC_PATH . 'themes/');
        putenv('WELLCART_THEMES_PATH=' . WELLCART_THEMES_PATH);

        defined('WELLCART_MEDIA_PATH')
        || define('WELLCART_MEDIA_PATH', WELLCART_PUBLIC_PATH . 'media/');
        putenv('WELLCART_MEDIA_PATH=' . WELLCART_MEDIA_PATH);
        /**
         * Define possible vendor path
         */
        if (!defined('WELLCART_VENDOR_PATH')) {
            define(
                'WELLCART_VENDOR_PATH',
                WELLCART_ROOT . 'vendor/'
            );
        }
        putenv('WELLCART_VENDOR_PATH=' . WELLCART_VENDOR_PATH);

        // Define application environment
        if (!isset($_ENV['WELLCART_APPLICATION_ENV'])) {
            $_ENV['WELLCART_APPLICATION_ENV'] = getenv(
                'WELLCART_APPLICATION_ENV'
            )
                ?: 'production';
        }

        // Define application context
        if (!isset($_ENV['WELLCART_APPLICATION_CONTEXT'])) {
            $_ENV['WELLCART_APPLICATION_CONTEXT'] = getenv(
                'WELLCART_APPLICATION_CONTEXT'
            ) ?: 'global';
        }
        
        if (empty($_SERVER['ENABLE_IIS_REWRITES']) || ($_SERVER['ENABLE_IIS_REWRITES'] != 1)) {
            /*
             * Unset headers used by IIS URL rewrites.
             */
            unset($_SERVER['HTTP_X_REWRITE_URL']);
            unset($_SERVER['HTTP_X_ORIGINAL_URL']);
            unset($_SERVER['IIS_WasUrlRewritten']);
            unset($_SERVER['UNENCODED_URL']);
            unset($_SERVER['ORIG_PATH_INFO']);
        }

        // Set error reporting level.
        error_reporting(E_ALL | E_STRICT);
        ini_set('log_errors', true);
        ini_set('display_errors', true);
        ini_set('display_startup_errors', true);
        ini_set('short_open_tag', true);

        if (PHP_SAPI == 'cli') {
            ini_set('max_execution_time', 0);
        } else {
            ini_set('max_execution_time', 800);
        }

        if (extension_loaded('xdebug')) {
            ini_set('xdebug.collect_params', 3);
            ini_set('xdebug.max_nesting_level', 30000);
            ini_set('xdebug.scream', false);
            ini_set('xdebug.show_exception_trace', false);
        }

        ini_set('precision', 14);
        ini_set('serialize_precision', 14);

        umask(0);
        ini_set('memory_limit', '1024M');

        if (function_exists('bcscale')) {
            bcscale(3);
        }

        session_cache_limiter(false);
        session_name('sid');

        ini_set('session.gc_probability', 1);
        ob_start();

        //Set the default time zone.
        date_default_timezone_set('UTC');
        ini_set('date.timezone', 'UTC');

        // Set internal encoding
        mb_language('uni');
        mb_regex_encoding("UTF-8");
        mb_internal_encoding("UTF-8");
        setlocale(LC_NUMERIC, 'C');

        ini_set('output_encoding', 'UTF-8');
        ini_set('input_encoding', 'UTF-8');
        ini_set('default_charset', 'UTF-8');

        if (function_exists('bind_textdomain_codeset')) {
            bind_textdomain_codeset("messages", 'UTF-8');
        }

        // Set the default locale.
        setlocale(LC_ALL, 'en_US.utf-8');

        ini_set('intl.default_locale', 'en-US');

        Locale::setDefault('en-US');
        foreach([
        'realpath_cache_size'     => '128K',
        'realpath_cache_ttl'      => 1800,
        'upload_tmp_dir'          => WELLCART_UPLOAD_PATH,
        'file_uploads'            => true,        
        'max_input_nesting_level' => 64,
        'max_input_vars'          => 500,
        'upload_max_filesize'     => '30M',
        'max_post_size'           => '30M',
        'max_file_uploads'        => 10,
        'error_log'               => WELLCART_STORAGE_PATH . 'logs' . DS . 'error.log',
        'session.save_path'       => WELLCART_STORAGE_PATH . 'sessions' . DS,
        ] as $key => $value)
        {
            ini_set($key, $value);
        }

        $errorHandler = new ErrorHandler();
        // Enable error handling, converts all PHP errors to exceptions.
        set_error_handler([$errorHandler, 'convertErrorsToExceptions']);
        // Enable exception handling
        set_exception_handler(
            [$errorHandler, 'maintenanceModeOnExceptionRaising']
        );
        // Exception handling on shutdown
        register_shutdown_function(
            [$errorHandler, 'maintenanceModeOnShutdown']
        );

        Bootup::initAll(
        ); // Enables the portability layer and configures PHP for UTF-8
        Bootup::filterRequestUri(
        ); // Redirects to an UTF-8 encoded URL if it's not already the case
        Bootup::filterRequestInputs(); // Normalizes HTTP inputs to UTF-8 NFC

        if (PHP_SAPI == 'cli') {
            (new \NunoMaduro\Collision\Provider)->register();
        }
        return true;
    }
}