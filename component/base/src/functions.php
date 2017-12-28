<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

use WellCart\Mvc\Application;

if (!function_exists('application')) {

    /**
     * Get application instance
     *
     * @param \WellCart\Mvc\Application $instance
     *
     * @return \WellCart\Mvc\Application
     */
    function application(Application $instance = null)
    {
        static $app;
        if ($instance !== null) {
            $app = $instance;
        }

        return $app;
    }

}

if (!function_exists('url_to_route')) {

    /**
     * Generates a url given the name of a route.
     *
     * @see    Zend\Router\RouteInterface::assemble()
     *
     * @param  string            $name               Name of the route
     * @param  array             $params             Parameters for the link
     * @param  array|Traversable $options            Options for the route
     * @param  bool              $reuseMatchedParams Whether to reuse matched parameters
     *
     * @return string Url                         For the link href attribute
     */
    function url_to_route(
        $name = null,
        $params = [],
        $options = [],
        $reuseMatchedParams = false
    ) {
        static $urlHelper;
        if ($urlHelper === null) {
            $urlHelper = application()
                ->getServiceManager()
                ->get('ViewHelperManager')
                ->get('url');
        }

        return $urlHelper($name, $params, $options, $reuseMatchedParams);
    }

}

if (!function_exists('e')) {

    /**
     * Escape a string for the HTML Body context where there are very few characters
     * of special meaning. Internally this will use htmlspecialchars().
     *
     * @param string $string
     *
     * @return string
     */
    function e($string)
    {
        static $escaper;
        if ($escaper === null) {
            $escaper = new Zend\Escaper\Escaper();
        }

        return $escaper->escapeHtml($string);
    }

}

if (!function_exists('__')) {

    /**
     * Translation/internationalization function.
     *
     * @param   string $string text to translate
     *
     * @return  string
     */
    function __(
        string $string,
        $plural = null,
        $number = null,
        $textDomain = null,
        $locale = null
    ) {
        $textDomain = ($textDomain) ?: 'default';

        static $translator;
        if ($translator === null) {
            $translator = application()->getServiceManager()
                ->get('translator');
        }
        if ($plural !== null && $number !== null) {
            return $translator->translatePlural(
                $string,
                $plural,
                $number,
                $textDomain,
                $locale
            );
        }

        return $translator->translate($string, $textDomain, $locale);
    }

}

if (!function_exists('ddump')) {

    /**
     * Debug helper function.
     *
     * @param  mixed  $var   The variable to dump.
     * @param  string $label OPTIONAL Label to prepend to output.
     *
     * @return string
     */
    function ddump($var, $label = null)
    {
        // format the label
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        $output = '<pre>'
            . $label
            . print_r($var, true)
            . '</pre>';
        echo $output;
        exit(1);
    }

}

if (!function_exists('format_price')) {
    function format_price($number, $withSymbol = true)
    {
        $number = doubleval($number);
        $locale = localeconv();

        static $symbol;
        if ($symbol === null) {
            $symbol = application()
                ->getServiceManager()
                ->get('directory\primary_currency')
                ->getSymbol();
        }
        if (!$withSymbol) {
            $symbol = '';
        }

        return $symbol . number_format(
                $number,
                2,
                $locale['decimal_point'],
                $locale['thousands_sep']
            );
    }
}
