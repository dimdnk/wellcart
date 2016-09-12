<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ModuleManager\Service;

use PDO;
use PDOException;
use PDOStatement;
use WellCart\Db\Adapter\Driver\Pdo\Connection;
use WellCart\Utility\Arr;
use WellCart\Utility\Valid;
use Zend\Config\Config;

class SystemConfigDbReader
{
    /**
     * SQL query
     */
    const SQL = 'SELECT * FROM base_configuration WHERE context IS NULL';

    /**
     * Config
     *
     * @var Config
     */
    protected $config;

    /**
     * Get system configuration from default datasource
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection = null)
    {
        if ($connection === null) {
            $parameters = include
                WELLCART_ROOT . 'config/autoload/db.global.php';
            $defaultConfig = array(
                'driver_options' => array(
                    1002 => "SET NAMES UTF8 COLLATE utf8_general_ci"
                ),
                'options'        => array(
                    'buffer_results' => true,
                ),
            );

            if (!empty($parameters['db']['adapters']['Zend\Db\Adapter\Adapter'])) {
                $dbConfig
                    = $parameters['db']['adapters']['Zend\Db\Adapter\Adapter'];
            } elseif (!empty($parameters['db']['adapters']['Zend\\Db\\Adapter\\Adapter'])) {
                $dbConfig
                    = $parameters['db']['adapters']['Zend\\Db\\Adapter\\Adapter'];
            } else {
                $dbConfig = $parameters['db'];
            }

            $dbConfig = Arr::merge($defaultConfig, $dbConfig);
            $connection = new Connection($dbConfig);
        }

        try {
            /** @var $result \PDOStatement */
            $result = $connection->getResource()->query(static::SQL);
            if ($result instanceof PDOStatement) {
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                $this->config = $this->buildConfig($rows);
            }
        } catch (PDOException $e) {
            $this->config = new Config([]);
        }

    }

    /**
     * Build config object
     *
     * @param array $rows
     *
     * @return Config
     */
    protected function buildConfig(array $rows)
    {
        $config = [];
        foreach ($rows as $row) {
            $key = Arr::get($row, 'config_key');
            $value = Arr::get($row, 'config_value');
            if ($key !== null) {
                if (Valid::digit($value)) {
                    $value = intval($value);
                }

                switch ($value) {
                    case 'no';
                        $value = false;
                        break;
                    case 'yes';
                        $value = true;
                        break;
                    case '';
                        $value = null;
                        break;
                }
                Arr::set($config, $key, $value);
            }
        }
        return new Config($config);
    }

    /**
     * Retrieve config object
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }
}