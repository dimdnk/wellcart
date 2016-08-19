<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Db\Adapter;

use BjyProfiler\Db\Adapter\ProfilingAdapter;
use Zend\Db\Adapter\Platform\PlatformInterface;
use Zend\Db\Adapter\Profiler\ProfilerInterface;
use Zend\Db\ResultSet\ResultSetInterface;

class SlaveAdapter extends ProfilingAdapter
{
    /**
     * Object constructor
     *
     * @param array|\Zend\Db\Adapter\Driver\DriverInterface $driver
     * @param ProfilerInterface                             $profiler
     * @param PlatformInterface                             $platform
     * @param ResultSetInterface                            $queryResultPrototype
     */
    public function __construct(
        $driver, ProfilerInterface $profiler,
        PlatformInterface $platform = null,
        ResultSetInterface $queryResultPrototype = null
    ) {
        parent:: __construct(
            $driver, $platform, $queryResultPrototype, $profiler
        );
    }
}