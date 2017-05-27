<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

/**
 * Check PHP version
 */
if (version_compare(phpversion(), '7.1.0', '<') === true) {
    echo 'WellCart supports PHP 7.1.0 or newer. Your version is '
        . phpversion() . '.';
    exit;
}

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(
        __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
    )
) {
    return false;
}

$_ENV['WELLCART_APPLICATION_ENV'] = 'production';

// Setup autoloading
$app = include '../bootstrap.php';
$app->run();