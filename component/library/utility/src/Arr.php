<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


namespace WellCart\Utility;

use Closure;

/**
 * Array helper.
 */
abstract class Arr
{

    /**
     * Sets an array value using "dot notation".
     *
     * @param array  $array Array you want to modify
     * @param string $path  Array path
     * @param mixed  $value Value to set
     */
    public static function set(array &$array, $path, $value)
    {
        $segments = explode('.', (string)$path);
        while (count($segments) > 1) {
            $segment = array_shift($segments);
            if (!isset($array[$segment]) || !is_array($array[$segment])) {
                $array[$segment] = [];
            }
            $array =& $array[$segment];
        }
        $array[array_shift($segments)] = $value;
    }

    /**
     * Search for an array value using "dot notation". Returns TRUE if the array key exists and FALSE if not.
     *
     * @param array  $array Array we're goint to search
     * @param string $path  Array path
     *
     * @return boolean
     */
    public static function has(array $array, $path)
    {
        $segments = explode('.', (string)$path);
        foreach ($segments as $segment) {
            if (!is_array($array) || !isset($array[$segment])) {
                return false;
            }
            $array = $array[$segment];
        }

        return true;
    }

    /**
     * Gets a value from an array using a dot separated path.
     *
     *     // Get the value of $array['foo']['bar']
     *     $value = Arr::get($array, 'foo.bar');
     *
     * Using a wildcard "*" will search intermediate arrays and return an array.
     *
     *     // Get the values of "color" in theme
     *     $colors = Arr::get($array, 'theme.*.color');
     *
     *     // Using an array of keys
     *     $colors = Arr::get($array, array('theme', '*', 'color'));
     *
     * @param   array $array   array to search
     * @param   mixed $path    key path string (delimiter separated) or array of keys
     * @param   mixed $default default value if the path is not set
     * @param   mixed $delimiter
     *
     * @return  mixed
     */
    public static function get($array, $path, $default = null, $delimiter = '.')
    {
        if (!static::isArray($array)) {
            // This is not an array!
            return $default;
        }
        if (is_array($path)) {
            // The path has already been separated into keys
            $keys = $path;
        } else {
            if (array_key_exists($path, $array)) {
                // No need to do extra processing
                return $array[$path];
            }

            // Remove starting delimiters and spaces
            $path = ltrim($path, "{$delimiter} ");
            // Remove ending delimiters, spaces, and wildcards
            $path = rtrim($path, "{$delimiter} *");
            // Split the keys by delimiter
            $keys = explode($delimiter, $path);
        }
        do {
            $key = array_shift($keys);
            if (ctype_digit($key)) {
                // Make the key an integer
                $key = (int)$key;
            }
            if (isset($array[$key])) {
                if ($keys) {
                    if (static::isArray($array[$key])) {
                        // Dig down into the next part of the path
                        $array = $array[$key];
                    } else {
                        // Unable to dig deeper
                        break;
                    }
                } else {
                    // Found the path requested
                    return $array[$key];
                }
            } elseif ($key === '*') {
                // Handle wildcards
                $values = [];
                foreach ($array as $arr) {
                    if ($value = static::get($arr, implode('.', $keys))) {
                        $values[] = $value;
                    }
                }
                if ($values) {
                    // Found the values requested
                    return $values;
                } else {
                    // Unable to dig deeper
                    break;
                }
            } else {
                // Unable to dig deeper
                break;
            }
        } while ($keys);

        // Unable to find the value requested
        return $default;
    }

    /**
     * Test if a value is an array with an additional check for array-like objects.
     *
     *     // Returns TRUE
     *     Arr::isArray(array());
     *     Arr::isArray(new ArrayObject);
     *
     *     // Returns FALSE
     *     Arr::isArray(FALSE);
     *     Arr::isArray('not an array!');
     *     Arr::isArray(Database::instance());
     *
     * @param   mixed $value value to check
     *
     * @return  boolean
     */
    public static function isArray($value)
    {
        if (is_array($value)) {
            // Definitely an array
            return true;
        } else {
            // Possibly a Traversable object, functionally the same as an array
            return (is_object($value) AND $value instanceof \Traversable);
        }
    }


    /**
     * Deletes an array value using "dot notation".
     *
     * @param array  $array Array you want to modify
     * @param string $path  Array path
     *
     * @return boolean
     */
    public static function delete(array &$array, $path)
    {
        $segments = explode('.', (string)$path);
        while (count($segments) > 1) {
            $segment = array_shift($segments);
            if (!isset($array[$segment]) || !is_array($array[$segment])) {
                return false;
            }
            $array =& $array[$segment];
        }
        unset($array[array_shift($segments)]);

        return true;
    }

    /**
     * Returns a random value from an array.
     *
     * @param array $array Array you want to pick a random value from
     *
     * @return mixed
     */
    public static function random(array $array)
    {
        return $array[array_rand($array)];
    }

    /**
     * Returns TRUE if the array is associative and FALSE if not.
     *
     * @param array $array Array to check
     *
     * @return boolean
     */
    public static function isAssoc(array $array)
    {
        return count(array_filter(array_keys($array), 'is_string')) === count(
                $array
            );
    }

    /**
     * Returns the values from a single column of the input array, identified by the key.
     *
     * @param array  $array Array to pluck from
     * @param string $key   Array key
     *
     * @return array
     */
    public static function pluck(array $array, $key)
    {
        return array_map(
            function ($value) use ($key) {
                return is_object($value) ? $value->$key : $value[$key];
            }, $array
        );
    }

    /**
     * Build a new array using a callback.
     *
     * @param array   $array
     * @param Closure $callback
     *
     * @return array
     */
    public static function build($array, Closure $callback)
    {
        $results = [];
        foreach ($array as $key => $value) {
            list($innerKey, $innerValue) = call_user_func(
                $callback, $key, $value
            );
            $results[$innerKey] = $innerValue;
        }

        return $results;
    }

    /**
     * Divide an array into two arrays. One with keys and the other with values.
     *
     * @param array $array
     *
     * @return array
     */
    public static function divide($array)
    {
        return [array_keys($array), array_values($array)];
    }

    /**
     * Get all of the given array except for a specified array of items.
     *
     * @param array        $array
     * @param array|string $keys
     *
     * @return array
     */
    public static function except($array, $keys)
    {
        return array_diff_key($array, array_flip((array)$keys));
    }

    /**
     * Fetch a flattened array of a nested array element.
     *
     * @param array  $array
     * @param string $key
     *
     * @return array
     */
    public static function fetch($array, $key)
    {
        $results = [];
        foreach (explode('.', $key) as $segment) {
            $results = [];
            foreach ($array as $value) {
                $value = (array)$value;
                $results[] = $value[$segment];
            }
            $array = array_values($results);
        }

        return array_values($results);
    }

    /**
     * Get a subset of the items from the given array.
     *
     * @param array        $array
     * @param array|string $keys
     *
     * @return array
     */
    public static function only($array, $keys)
    {
        return array_intersect_key($array, array_flip((array)$keys));
    }

    /**
     * Return the last element in an array passing a given truth test.
     *
     * @param array    $array
     * @param \Closure $callback
     * @param mixed    $default
     *
     * @return mixed
     */
    public static function last($array, $callback, $default = null)
    {
        return static::first(array_reverse($array), $callback, $default);
    }

    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param array    $array
     * @param \Closure $callback
     * @param mixed    $default
     *
     * @return mixed
     */
    public static function first($array, $callback, $default = null)
    {
        foreach ($array as $key => $value) {
            if (call_user_func($callback, $key, $value)) {
                return $value;
            }
        }

        return $default instanceof Closure ? $default() : $default;
    }

    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param array $array
     *
     * @return array
     */
    public static function flatten($array)
    {
        $return = [];
        array_walk_recursive(
            $array, function ($x) use (&$return) {
            $return[] = $x;
        }
        );

        return $return;
    }

    /**
     * Filter the array using the given Closure.
     *
     * @param array    $array
     * @param \Closure $callback
     *
     * @return array
     */
    public static function where($array, Closure $callback)
    {
        $filtered = [];
        foreach ($array as $key => $value) {
            if (call_user_func($callback, $key, $value)) {
                $filtered[$key] = $value;
            }
        }

        return $filtered;
    }

    /**
     * Merge two arrays together.
     *
     * If an integer key exists in both arrays and preserveNumericKeys is false, the value
     * from the second array will be appended to the first array. If both values are arrays, they
     * are merged together, else the value of the second array overwrites the one of the first array.
     *
     * @param  array $a
     * @param  array $b
     * @param  bool  $preserveNumericKeys
     *
     * @return array
     */
    public static function merge(
        array $a, array $b, $preserveNumericKeys = false
    ) {
        foreach ($b as $key => $value) {
            if (array_key_exists($key, $a)) {
                if (is_int($key) && !$preserveNumericKeys) {
                    $a[] = $value;
                } elseif (is_array($value) && is_array($a[$key])) {
                    $a[$key] = static::merge(
                        $a[$key], $value, $preserveNumericKeys
                    );
                } else {
                    $a[$key] = $value;
                }
            } else {
                $a[$key] = $value;
            }
        }

        return $a;
    }

    /**
     * Flattening a multi-dimensional array into a
     * single-dimensional one. The resulting keys are a
     * string-separated list of the original keys:
     *
     * a[x][y][z] becomes a[implode(sep, array(x,y,z))]
     *
     * @param        $array
     * @param string $sep
     *
     * @return array
     */
    public static function flattenSeparated($array, $sep = ".")
    {
        $result = [];
        $stack = [];
        array_push($stack, ["", $array]);

        while (count($stack) > 0) {
            list($prefix, $array) = array_pop($stack);

            foreach ($array as $key => $value) {
                $newKey = $prefix . strval($key);

                if (is_array($value)) {
                    array_push($stack, [$newKey . $sep, $value]);
                } else {
                    $result[$newKey] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * Remove any elements where the callback returns true
     *
     * @param  array    $array    the array to walk
     * @param  callable $callback callback takes ($value, $key, $userdata)
     * @param  mixed    $userdata additional data passed to the callback.
     *
     * @return array
     */
    public static function arrayWalkRecursiveDelete(array &$array,
        callable $callback, $userdata = null
    ) {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $value = static::arrayWalkRecursiveDelete(
                    $value, $callback, $userdata
                );
            }
            if ($callback($value, $key, $userdata)) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    /**
     * A version of in_array() that does a sub string match on $needle
     *
     * @param  mixed $needle   The searched value
     * @param  array $haystack The array to search in
     *
     * @return boolean
     */
    public static function substrInArray($needle, array $haystack)
    {
        $filtered = array_filter(
            $haystack, function ($item) use ($needle) {
            return false !== strpos($item, $needle);
        }
        );

        return !empty($filtered);
    }
}