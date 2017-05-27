<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

// display errors

use WellCart\Utility\PHPEnvironment;

ini_set('display_errors', true);

// turn on all errors
error_reporting(E_ALL);

// set timezone
date_default_timezone_set('UTC');

defined('REQUEST_MICROTIME') || define('REQUEST_MICROTIME', microtime(true));
define('TIME_NOW', time());

// check PHP version
if (version_compare(phpversion(), '7.1.0', '<') === true) {
    throw new RuntimeException(
        'WellCart Utility supports PHP 7.1.0 or newer. Your version is '
        . phpversion() . ".\n"
    );
}

// setup autoloading
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    include_once dirname(__DIR__) . '/vendor/autoload.php';
} else {
    throw new RuntimeException(
        "Unable to load WellCart Utility Library. Run `composer install`.\n"
    );
}

PHPEnvironment::initialize();
