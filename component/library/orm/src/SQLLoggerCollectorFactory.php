<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM;

use DoctrineORMModule\Collector\SQLLoggerCollector;
use DoctrineORMModule\Service\SQLLoggerCollectorFactory as AbstractSQLLoggerCollectorFactory;
use Interop\Container\ContainerInterface;

class SQLLoggerCollectorFactory extends AbstractSQLLoggerCollectorFactory
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceLocator,
        $requestedName,
        array $options = null
    ) {
        /** @var $options \DoctrineORMModule\Options\SQLLoggerCollectorOptions */
        $options = $this->getOptions($serviceLocator);

        /* @var $configuration \Doctrine\ORM\Configuration */
        $configuration = $serviceLocator->get($options->getConfiguration());
        return new SQLLoggerCollector(
            $configuration->getSQLLogger(),
            'doctrine.sql_logger_collector.' . $options->getName()
        );
    }
}