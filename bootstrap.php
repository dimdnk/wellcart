<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

use Dotenv\Dotenv;
use WellCart\Mvc\Application;
use WellCart\Utility\Config;
use WellCart\Utility\PHPEnvironment;

if (!defined('WELLCART')):
    /**
     * Check PHP version
     */
    if (version_compare(phpversion(), '7.1.0', '<') === true) {

        $phpVersion = phpversion();

        if (PHP_SAPI == 'cli') {
            echo 'WellCart supports PHP 7.1.0 or newer. Your version is '
                . $phpVersion . ".\n";
        } else {
            echo <<<HTML
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>WellCart Platform</title>
        </head>
        <body>
        <h4>Whoops, it looks like you have an invalid PHP version.</h4>
        <p>WellCart supports PHP 7.1.0 or newer. Your version is $phpVersion.</p>
        </body>
    </html>
HTML;
        }
        exit;
    }

    /**
     * This makes our life easier when dealing with paths. Everything is relative
     * to the application root now.
     */
    chdir(__DIR__);

    if (file_exists('vendor/autoload.php')) {
        include_once 'vendor/autoload.php';
    }

    if (!class_exists('WellCart\Mvc\Application')) {
        if (PHP_SAPI == 'cli') {
            echo "WellCart Platform uses Composer to manage package dependencies. Go to application root folder and run composer installation `composer install`.\n";
        } else {
            echo <<<HTML
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>WellCart Platform</title>
        </head>
        <body>
            <h4>WellCart Platform uses Composer to manage package dependencies</h4>
            <p>Go to application root folder and run composer installation `composer install`.</p>
        </body>
    </html>
HTML;
        }
        exit;
    }

    if (is_file(__DIR__ . '/config/.env')) {
      $dotenv = new Dotenv(__DIR__ . '/config/');
      $dotenv->load();
    }

    defined('WELLCART_ROOT')
    || define('WELLCART_ROOT', str_replace('\\', '/', __DIR__) . '/');

    defined('WELLCART_BIN_PATH')
    || define('WELLCART_BIN_PATH', WELLCART_ROOT . 'bin/');

    defined('WELLCART_VENDOR_PATH')
    || define('WELLCART_VENDOR_PATH', WELLCART_ROOT . 'vendor/');

    defined('WELLCART_STORAGE_PATH')
    || define('WELLCART_STORAGE_PATH', WELLCART_ROOT . 'data/');
    defined('WELLCART_PUBLIC_PATH')
    || define(
        'WELLCART_PUBLIC_PATH', WELLCART_ROOT . 'public/'
    );
    defined('WELLCART_MEDIA_PATH')
    || define('WELLCART_MEDIA_PATH', WELLCART_PUBLIC_PATH . 'media/');
    defined('WELLCART_ASSETS_PATH')
    || define('WELLCART_ASSETS_PATH', WELLCART_PUBLIC_PATH . 'assets/');
    defined('WELLCART_THEMES_PATH')
    || define('WELLCART_THEMES_PATH', WELLCART_PUBLIC_PATH . 'themes/');

    if (!is_file(WELLCART_ROOT . 'config/autoload/installed.php')) {
        $_ENV['WELLCART_APPLICATION_CONTEXT'] = Application::CONTEXT_SETUP;
    } else {
        if (empty($_ENV['WELLCART_APPLICATION_CONTEXT'])) {
            if (php_sapi_name() == "cli") {
                $_ENV['WELLCART_APPLICATION_CONTEXT']
                    = Application::CONTEXT_COMMON;
            } else {
                $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                if (strlen($urlPath) >= 6
                    && substr($urlPath, 0, 6) == '/admin'
                ) {
                    $_ENV['WELLCART_APPLICATION_CONTEXT']
                        = Application::CONTEXT_BACKEND;
                } elseif (strlen($urlPath) >= 4
                    && substr($urlPath, 0, 4) == '/api'
                ) {
                    $_ENV['WELLCART_APPLICATION_CONTEXT']
                        = Application::CONTEXT_API;
                } else {
                    $_ENV['WELLCART_APPLICATION_CONTEXT']
                        = Application::CONTEXT_FRONTEND;
                }
            }
        }
    }

    /**
     * Setup initial PHP environment
     */
    PHPEnvironment::initialize();
    $application = Application::init(
        Config::application(
            include WELLCART_ROOT . 'config/application.config.php'
        )
    );

    define('WELLCART', true);
else:
    $application = application();
endif;

return $application;