<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Db\Adapter;

use BjyProfiler\Db\Adapter\ProfilingAdapter;
use Zend\Db\Adapter\Platform\PlatformInterface;
use Zend\Db\Adapter\Profiler\ProfilerInterface;
use Zend\Db\ResultSet\ResultSetInterface;
use ZfcBase\Db\Adapter\MasterSlaveAdapterInterface;

class MasterAdapter extends ProfilingAdapter
    implements MasterSlaveAdapterInterface
{

    /**
     * Slave adapter
     *
     * @var SlaveAdapter
     */
    protected $slaveAdapter;

    /**
     * Object constructor
     *
     * @param array|\Zend\Db\Adapter\Driver\DriverInterface $driver
     * @param SlaveAdapter                                  $slaveAdapter
     * @param ProfilerInterface                             $profiler
     * @param PlatformInterface                             $platform
     * @param ResultSetInterface                            $queryResultPrototype
     */
    public function __construct(
        $driver, SlaveAdapter $slaveAdapter,
        ProfilerInterface $profiler,
        PlatformInterface $platform = null,
        ResultSetInterface $queryResultPrototype = null

    ) {
        parent:: __construct(
            $driver, $platform, $queryResultPrototype, $profiler
        );
        $this->slaveAdapter = $slaveAdapter;
    }

    /**
     * Retrieve slave adapter instance
     *
     * @return \Zend\Db\Adapter\Adapter
     */
    public function getSlaveAdapter()
    {
        return $this->slaveAdapter;
    }
}