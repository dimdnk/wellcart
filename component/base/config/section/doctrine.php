<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
use WellCart\Utility\Arr;

$dbConfigFile = WELLCART_ROOT . 'config/autoload/db.global.php';
if (!is_file($dbConfigFile)) {
    $dbConfigFile = __DIR__ . '/../../tests/config/autoload/db.global.php';
    if (!is_file($dbConfigFile)) {
        $dbConfigFile = __DIR__
            . '/../../tests/config/autoload/db.global.php.dist';
    }
}

$dbConfigFile = include $dbConfigFile;
$masterDbConfig = Arr::get(
    $dbConfigFile,
    'db.adapters.Zend\Db\Adapter\Adapter',
    Arr::get($dbConfigFile, 'db', [])
);

$slaveDbConfig = Arr::get(
    $dbConfigFile,
    'db.adapters.DbDefaultSlaveConnection',
    $masterDbConfig
);

$driverClass = (Arr::get($masterDbConfig, 'driver') != 'pdo_mysql') ? 'PDOPgSql'
    : 'PDOMySql';

return [
    // SQL logger collector, used when ZendDeveloperTools and its toolbar are active
    'sql_logger_collector' => [
        // configuration for the `doctrine.sql_logger_collector.orm_default` service
        'orm_default' => [],
    ],
    'connection'           => [
        'orm_default' => [
            // configuration instance to use. The retrieved service name will
            // be `doctrine.configuration.$thisSetting`
            'configuration' => 'orm_default',
            // event manager instance to use. The retrieved service name will
            // be `doctrine.eventmanager.$thisSetting`
            'eventmanager'  => 'orm_default',
            'wrapperClass'  => 'Doctrine\DBAL\Connections\MasterSlaveConnection',
            'driverClass'   =>
                'Doctrine\DBAL\Driver\\' . $driverClass . '\Driver',
            'params'        => [
                'host'           => Arr::get(
                    $masterDbConfig,
                    'host',
                    'localhost'
                ),
                'port'           => Arr::get($masterDbConfig, 'port', 3306),
                'user'           => Arr::get(
                    $masterDbConfig,
                    'username',
                    'root'
                ),
                'password'       => Arr::get($masterDbConfig, 'password'),
                'dbname'         => Arr::get(
                    $masterDbConfig,
                    'database',
                    'wellcart'
                ),
                'charset'        => 'utf8',
                'driver_options' => [
                    1002 => "SET NAMES UTF8 COLLATE utf8_general_ci"
                ],
                'driver'         => Arr::get(
                    $masterDbConfig,
                    'driver',
                    'pdo_mysql'
                ),
                'master'         => [
                    'host'           => Arr::get(
                        $masterDbConfig,
                        'host',
                        'localhost'
                    ),
                    'port'           => Arr::get($masterDbConfig, 'port', 3306),
                    'user'           => Arr::get(
                        $masterDbConfig,
                        'username',
                        'root'
                    ),
                    'password'       => Arr::get($masterDbConfig, 'password'),
                    'dbname'         => Arr::get(
                        $masterDbConfig,
                        'database',
                        'wellcart'
                    ),
                    'charset'        => 'utf8',
                    'driver_options' => [
                        1002 => "SET NAMES UTF8 COLLATE utf8_general_ci"
                    ],
                ],
                'slaves'         => [
                    [
                        'host'           => Arr::get(
                            $slaveDbConfig,
                            'host',
                            'localhost'
                        ),
                        'port'           => Arr::get(
                            $slaveDbConfig,
                            'port',
                            3306
                        ),
                        'user'           => Arr::get(
                            $slaveDbConfig,
                            'username',
                            'root'
                        ),
                        'password'       => Arr::get(
                            $slaveDbConfig,
                            'password'
                        ),
                        'dbname'         => Arr::get(
                            $slaveDbConfig,
                            'database',
                            'wellcart'
                        ),
                        'charset'        => 'utf8',
                        'driver_options' => [
                            1002 => "SET NAMES UTF8 COLLATE utf8_general_ci"
                        ],
                    ],
                ],
            ],
        ],
    ],
    'driver'               => [
        'wellcart_base_driver' => [
            'class' => 'WellCart\ORM\Mapping\Driver\SystemConfigDriver',
            'cache' => 'array',
            'paths' => [
                __DIR__ => __DIR__,
            ],
        ],
        // default metadata driver, aggregates all other drivers into a single one.
        'orm_default'          => [
            'drivers' => [
                'WellCart\Base\Entity' => 'wellcart_base_driver',
            ]
        ]
    ],
    'cache'                => [
        'apc'        => [
            'namespace' => 'WellCartORM',
        ],
        'array'      => [
            'namespace' => 'WellCartORM',
        ],
        'filesystem' => [
            'directory' => WELLCART_STORAGE_PATH . 'cache',
            'namespace' => 'WellCartORM',
        ],
        'memcache'   => [
            'instance'  => 'wellcart_doctrine_memcache',
            'namespace' => 'WellCartORM',
        ],
        'memcached'  => [
            'instance'  => 'wellcart_doctrine_memcached',
            'namespace' => 'WellCartORM',
        ],
        'predis'     => [
            'instance'  => 'wellcart_doctrine_predis',
            'namespace' => 'WellCartORM',
        ],
        'redis'      => [
            'instance'  => 'wellcart_doctrine_redis',
            'namespace' => 'WellCartORM',
        ],
        'wincache'   => [
            'namespace' => 'WellCartORM',
        ],
        'xcache'     => [
            'namespace' => 'WellCartORM',
        ],
        'zenddata'   => [
            'namespace' => 'WellCartORM',
        ],
    ],
    // Configuration details for the ORM.
    // See http://docs.doctrine-project.org/en/latest/reference/configuration.html
    'configuration'        => [
        // Configuration for service `doctrine.configuration.orm_default` service
        'orm_default' => [
            'entity_listener_resolver' => 'WellCart\ORM\Mapping\EntityListenerResolver',
            //'repository_factory' => 'WellCart\ORM\Repository\RepositoryFactory',
            // metadata cache instance to use. The retrieved service name will
            // be `doctrine.cache.$thisSetting`
            'metadata_cache'           => 'array',
            // DQL queries parsing cache instance to use. The retrieved service
            // name will be `doctrine.cache.$thisSetting`
            'query_cache'              => 'array',
            // ResultSet cache to use.  The retrieved service name will be
            // `doctrine.cache.$thisSetting`
            'result_cache'             => 'array',
            // Hydration cache to use.  The retrieved service name will be
            // `doctrine.cache.$thisSetting`
            'hydration_cache'          => 'array',
            'sql_logger'               => 'Doctrine\DBAL\Logging\DebugStack',
            // Generate proxies automatically (turn off for production)
            'generate_proxies'         => false,
            // directory where proxies will be stored. By default, this is in
            // the `data` directory of your application
            'proxy_dir'                => WELLCART_STORAGE_PATH . 'code',
            // namespace for generated proxy classes
            'proxy_namespace'          => 'WellCartORM\Proxy',
            // SQL filters. See http://docs.doctrine-project.org/en/latest/reference/filters.html
            'filters'                  => [],

            /**
             * 'generate_hydrators'       => true,
             * 'hydrator_dir'             => WELLCART_STORAGE_PATH . 'code',
             * 'hydrator_namespace'       => 'WellCartORM\Hydrator',
             */

            // Custom DQL functions.
            // You can grab common MySQL ones at https://github.com/beberlei/DoctrineExtensions
            // Further docs at http://docs.doctrine-project.org/en/latest/cookbook/dql-user-defined-functions.html
            'datetime_functions'       => [
                'YEAR'          => 'DoctrineExtensions\Query\Mysql\Year',
                'WEEK'          => 'DoctrineExtensions\Query\Mysql\Week',
                'TIMESTAMPDIFF' => 'DoctrineExtensions\Query\Mysql\TimestampDiff',
                'STR_TO_DATE'   => 'DoctrineExtensions\Query\Mysql\StrToDate',
                'DAY'           => 'DoctrineExtensions\Query\Mysql\Day',
                'DATE_FORMAT'   => 'DoctrineExtensions\Query\Mysql\DateFormat',
                'DATEDIFF'      => 'DoctrineExtensions\Query\Mysql\DateDiff',
                'DATE'          => 'DoctrineExtensions\Query\Mysql\Date',
                'MONTH'         => 'DoctrineExtensions\Query\Mysql\Month',
                'HOUR'          => 'DoctrineExtensions\Query\Mysql\Hour',
            ],
            'string_functions'         => [
                'SHA1'          => 'DoctrineExtensions\Query\Mysql\Sha1',
                'SHA2'          => 'DoctrineExtensions\Query\Mysql\Sha2',
                'MD5'           => 'DoctrineExtensions\Query\Mysql\Md5',
                'CRC32'         => 'DoctrineExtensions\Query\Mysql\Crc32',
                'BINARY'        => 'DoctrineExtensions\Query\Mysql\Binary',
                'CHAR_LENGTH'   => 'DoctrineExtensions\Query\Mysql\CharLength',
                'CONCAT_WS'     => 'DoctrineExtensions\Query\Mysql\ConcatWs',
                'GROUP_CONCAT'  => 'DoctrineExtensions\Query\Mysql\GroupConcat',
                'MATCH_AGAINST' => 'DoctrineExtensions\Query\Mysql\MatchAgainst',
            ],
            'numeric_functions'        => [
                'ROUND'   => 'DoctrineExtensions\Query\Mysql\Round',
                'RAND'    => 'DoctrineExtensions\Query\Mysql\Rand',
                'ACOS'    => 'DoctrineExtensions\Query\Mysql\Acos',
                'ASIN'    => 'DoctrineExtensions\Query\Mysql\Asin',
                'ATAN'    => 'DoctrineExtensions\Query\Mysql\Atan',
                'ATAN2'   => 'DoctrineExtensions\Query\Mysql\Atan2',
                'COS'     => 'DoctrineExtensions\Query\Mysql\Cos',
                'COT'     => 'DoctrineExtensions\Query\Mysql\Cot',
                'COUNTIF' => 'DoctrineExtensions\Query\Mysql\CountIf',
                'DEGREES' => 'DoctrineExtensions\Query\Mysql\Degrees',
                'PI'      => 'DoctrineExtensions\Query\Mysql\Pi',
                'RADIANS' => 'DoctrineExtensions\Query\Mysql\Radians',
                'SIN'     => 'DoctrineExtensions\Query\Mysql\Sin',
                'TAN'     => 'DoctrineExtensions\Query\Mysql\Tan',
            ],
            'types'                    => [
                'carbondatetime'   => 'DoctrineExtensions\Types\CarbonDateTimeType',
                'carbondatetimetz' => 'DoctrineExtensions\Types\CarbonDateTimeTzType',
                'carbondate'       => 'DoctrineExtensions\Types\CarbonDateType',
                'carbontime'       => 'DoctrineExtensions\Types\CarbonTimeType',
                'array'            => 'Oro\DBAL\Types\ArrayType',
                'money'            => 'Oro\DBAL\Types\MoneyType',
                'object'           => 'Oro\DBAL\Types\ObjectType',
                'percent'          => 'Oro\DBAL\Types\PercentType',
            ],
        ]
    ],
    'eventmanager'         => [
        'orm_default' => [
            'subscribers' => [
                'WellCart\Base\EventListener\SystemEntityListener' => 'WellCart\Base\EventListener\SystemEntityListener',
                'Gedmo\Timestampable\TimestampableListener'        => 'Gedmo\Timestampable\TimestampableListener',
                'Gedmo\SoftDeleteable\SoftDeleteableListener'      => 'Gedmo\SoftDeleteable\SoftDeleteableListener',
                'Gedmo\Translatable\TranslatableListener'          => 'Gedmo\Translatable\TranslatableListener',
                'Gedmo\Sluggable\SluggableListener'                => 'Gedmo\Sluggable\SluggableListener',
                'Gedmo\Tree\TreeListener'                          => 'Gedmo\Tree\TreeListener',
            ],
        ],
    ],
    'entity_resolver'      => [
        'orm_default' => [
            'resolvers' => [
                'WellCart\Base\Spec\ConfigurationEntity'  => 'WellCart\Base\Entity\Configuration',
                'WellCart\Base\Spec\LocaleLanguageEntity' => 'WellCart\Base\Entity\Locale\Language',
                'WellCart\Base\Spec\UrlRewriteEntity'     => 'WellCart\Base\Entity\UrlRewrite',
                'WellCart\Base\Spec\JobQueueEntity'       => 'WellCart\Base\Entity\Queue\Job',
                'Base::Configuration'                     => 'WellCart\Base\Entity\Configuration',
                'Base::Locale\Language'                   => 'WellCart\Base\Entity\Locale\Language',
                'Base::UrlRewrite'                        => 'WellCart\Base\Entity\UrlRewrite',
                'Base::Locale\Language\DefaultLanguage'   => 'WellCart\Base\Entity\Locale\Language\DefaultLanguage',
            ],
        ],
    ],
];
