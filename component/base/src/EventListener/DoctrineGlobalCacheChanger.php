<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener;

use WellCart\Utility\Config;
use Zend\EventManager\EventInterface;

class DoctrineGlobalCacheChanger
{

    /**
     * @param EventInterface $event
     *
     * @return bool
     */
    public function __invoke(EventInterface $event)
    {
        $values = &$event->getParams()['values'];
        $cacheInstance = (!empty($values['doctrine.global_cache_instance']))
            ?
            $values['doctrine.global_cache_instance']
            :
            Config::get('doctrine.global_cache_instance', 'array');

        $types = [
            'metadata_cache',
            'query_cache',
            'result_cache',
            'hydration_cache',
        ];

        $key = 'doctrine.configuration.orm_default.';
        foreach ($types as $type) {
            $values[$key . $type] = $cacheInstance;
        }

        $drivers = array_keys(Config::get('doctrine.driver', []));
        foreach ($drivers as $driverKey) {
            $key = 'doctrine.driver.' . $driverKey . '.cache';
            $values[$key] = $cacheInstance;
        }

        return true;
    }
}
