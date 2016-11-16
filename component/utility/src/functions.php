<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2016 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


use WellCart\Utility\Arr;
use WellCart\Utility\Str;

if (!function_exists('application_env')) {

    /**
     * Get or check the current application environment.
     *
     * @param  mixed
     *
     * @return string
     */
    function application_env()
    {
        $env = Arr::get($_ENV, 'WELLCART_APPLICATION_ENV', 'production');
        if (func_num_args() > 0) {
            $patterns = is_array(func_get_arg(0)) ? func_get_arg(0)
                : func_get_args();
            foreach ($patterns as $pattern) {
                if (Str::is($pattern, $env)) {
                    return true;
                }
            }
            return false;
        }
        return $env;
    }
}

if (!function_exists('application_context')) {

    /**
     * Get or check the current application context.
     *
     * @param  mixed
     *
     * @return string
     */
    function application_context()
    {
        $context = Arr::get($_ENV, 'WELLCART_APPLICATION_CONTEXT', 'global');
        if (func_num_args() > 0) {
            $patterns = is_array(func_get_arg(0)) ? func_get_arg(0)
                : func_get_args();
            foreach ($patterns as $pattern) {
                if (Str::is($pattern, $context)) {
                    return true;
                }
            }
            return false;
        }
        return $context;
    }
}

if (!function_exists('digit_count')) {
    function digit_count($n, $base = 10)
    {
        if ($n == 0) {
            return 1;
        }
        if ($base == 10) {
            // using the built-in log10(x)
            // might be more accurate than log(x)/log(10).
            return 1 + floor(log10(abs($n)));
        } else {
            // here  logB(x) = log(x)/log(B) will have to do.
            return 1 + floor(log(abs($n)) / log($base));
        }
    }
}

if (!function_exists('get_file_size')) {
    /**
     * Calculate the human-readable file size (with proper units).
     *
     * @param int $size
     *
     * @return string
     */
    function get_file_size($size)
    {
        $units = array('Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB');
        return @
        round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' '
        . $units[$i];
    }
}

if (!function_exists('glob_recursive')) {

    function glob_recursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);

        foreach (
            glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir
        ) {
            $files = array_merge(
                $files, glob_recursive($dir . '/' . basename($pattern), $flags)
            );
        }

        return $files;
    }
}
if (!function_exists('remove_directory')) {
    /**
     * Delete function that deals with directories recursively
     */
    function remove_directory($target)
    {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK);

            foreach ($files as $file) {
                remove_directory($file);
            }

            rmdir($target);
        } elseif (is_file($target)) {
            unlink($target);
        }
    }
}

if (!function_exists('copy_directory')) {
    function copy_directory($src, $destination)
    {
        $dir = opendir($src);
        @mkdir($destination, true);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    copy_directory(
                        $src . '/' . $file, $destination . '/' . $file
                    );
                } else {
                    copy($src . '/' . $file, $destination . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}

if (!function_exists('hex2rgb')) {
    function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb; // returns an array with the rgb values
    }
}
if (!function_exists('rgb2hex')) {
    function rgb2hex($rgb)
    {
        $hex = "#";
        $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

        return $hex; // returns the hex value including the number sign (#)
    }
}

if (!function_exists('str_object')) {
    /**
     * Determine if the given object has a toString method.
     *
     * @param object $value
     *
     * @return bool
     */
    function str_object($value)
    {
        return is_object($value) and method_exists($value, '__toString');
    }
}

if (!function_exists('root_namespace')) {
    /**
     * Get the root namespace of a given class.
     *
     * @param string $class
     * @param string $separator
     *
     * @return string
     */
    function root_namespace($class, $separator = '\\')
    {
        if (WellCart\Utility\Str::contains($class, $separator)) {
            $arr = explode($separator, $class);
            return reset($arr);
        }
    }
}


if (!function_exists('class_basename')) {
    /**
     * Get the "class basename" of a class or object.
     *
     * The basename is considered to be the name of the class minus all namespaces.
     *
     * @param object|string $class
     *
     * @return string
     */
    function class_basename($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        return basename(str_replace('\\', '/', $class));
    }
}

if (!function_exists('var_export_short')) {
    function var_export_short($data, $return = true)
    {
        $dump = var_export($data, true);

        $dump = preg_replace(
            '#(?:\A|\n)([ ]*)array \(#i', '[', $dump
        ); // Starts
        $dump = preg_replace('#\n([ ]*)\),#', "\n$1],", $dump); // Ends
        $dump = preg_replace('#=> \[\n\s+\],\n#', "=> [],\n", $dump); // Empties

        if (gettype($data) == 'object') { // Deal with object states
            $dump = str_replace('__set_state(array(', '__set_state([', $dump);
            $dump = preg_replace('#\)\)$#', "])", $dump);
        } else {
            $dump = preg_replace('#\)$#', "]", $dump);
        }

        if ($return === true) {
            return $dump;
        } else {
            echo $dump;
        }
    }
}