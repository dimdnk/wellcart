<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Db\Factory\Adapter;

use Interop\Container\ContainerInterface;
use WellCart\Db\Adapter\Driver\Pdo;
use WellCart\Db\Adapter\MasterAdapter;
use WellCart\Db\Adapter\SlaveAdapter;
use WellCart\Db\Profiler\Profiler;
use WellCart\Utility\Arr;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;

class MasterSlaveAdapterFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return MasterAdapter
     */
    public function __invoke(ContainerInterface $container): MasterAdapter
    {
        $config = $container->get('Configuration');
        if (!empty($config['db']['adapters']['Zend\Db\Adapter\Adapter'])) {
            $masterDbConfig
                = $config['db']['adapters']['Zend\Db\Adapter\Adapter'];
        } elseif (!empty($config['db']['adapters']['Zend\\Db\\Adapter\\Adapter'])) {
            $masterDbConfig
                = $config['db']['adapters']['Zend\\Db\\Adapter\\Adapter'];
        } else {
            $masterDbConfig = $config['db'];
        }

        if (!empty($config['db']['adapters']['DbDefaultSlaveConnection'])) {
            $slaveDbConfig
                = $config['db']['adapters']['DbDefaultSlaveConnection'];
        } else {
            $slaveDbConfig = $masterDbConfig;
        }

        $profiler = new Profiler;
        $masterPdo = new Pdo\Pdo(new Pdo\Connection($masterDbConfig));
        $slavePdo = new Pdo\Pdo(new Pdo\Connection($slaveDbConfig));

        $slaveAdapter = new SlaveAdapter($slavePdo, $profiler);
        $slaveAdapter->injectProfilingStatementPrototype(
            Arr::get($slaveDbConfig, 'options', [])
        );

        $masterAdapter = new MasterAdapter(
            $masterPdo, $slaveAdapter, $profiler
        );
        $masterAdapter->injectProfilingStatementPrototype(
            Arr::get($masterDbConfig, 'options', [])
        );

        GlobalAdapterFeature::setStaticAdapter($masterAdapter);

        return $masterAdapter;
    }
}