<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Service;

use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Output\NullOutput;
use Throwable;
use WellCart\Base\Service\ConfigurationEditor;
use WellCart\Console\Input\IgnoreValidationArrayInput;
use WellCart\Mvc\Application;
use WellCart\SchemaMigration\Console\Command\Migrate as SchemaMigrationCommand;
use WellCart\Setup\Console\Command;
use WellCart\Setup\Exception\RuntimeException;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use Zend\ServiceManager\ServiceManager;

class Setup
{

    /**
     * The lowest supported MySQL version
     */
    const MYSQL_VERSION_REQUIRED = '5.6.0';

    /**
     * @var ServiceManager
     */
    protected $sm;

    /**
     * Service constructor
     *
     * @param ContainerInterface $sm
     */
    public function __construct(ContainerInterface $sm)
    {
        $this->sm = $sm;
    }

    /**
     * Setup database connection & make schema updates
     *
     * @param array $data
     *
     * @throws Throwable
     */
    public function installDatabase(array $data)
    {
        $dbConfigFile = WELLCART_ROOT . 'config/autoload/db.global.php';
        $this->createDatabaseConfig($dbConfigFile, $data);
        try {
            ignore_user_abort(true);
            set_time_limit(0);
            $this->runInContext(
                Application::CONTEXT_GLOBAL,
                function () {
                    $this->checkDatabaseConnection();
                    $this->updateDatabaseSchema();
                    $this->generateProxyClasses();
                    $this->updateData();
                    $this->refreshPermissions();
                }
            );
        } catch (Throwable $e) {
            unlink($dbConfigFile);
            throw $e;
        } finally {
            ini_restore('max_execution_time');
        }
    }

    /**
     * Create database config
     *
     * @param array $data
     */
    protected function createDatabaseConfig($file, array $data)
    {
        $driver = Arr::get($data, 'driver', 'pdo_mysql');
        $driver = ($driver == 'pdo_pgsql') ? 'pdo_pgsql' : 'pdo_mysql';
        $params = [
            'driver'   => $driver,
            'username' => Arr::get($data, 'username', 'root'),
            'password' => Arr::get($data, 'password'),
            'port'     => (int)Arr::get($data, 'port', 3306),
            'host'     => Arr::get($data, 'host', 'localhost'),
            'database' => Arr::get($data, 'database', 'wellcart'),
        ];
        $params = [
            'db' => [
                'adapters' => [
                    'Zend\Db\Adapter\Adapter'  => $params,
                    'DbDefaultSlaveConnection' => $params,
                ],
            ],
        ];


        file_put_contents(
            $file,
            "<?php\n return " . var_export_short($params, true) . ";"
        );

        chmod($file, 0666);
    }

    /**
     * Run callback on mimic of installed system
     *
     * @param callable $func
     *
     * @throws Throwable
     */
    protected function runInContext($context, callable $func)
    {
        $_ENV['WELLCART_APPLICATION_CONTEXT'] = $context;
        $app = application();
        try {
            $app->enableMaintenanceMode();
            $configPath = WELLCART_ROOT . 'config/application.config.php';
            if (!is_file($configPath)) {
                $configPath = WELLCART_ROOT
                    . 'config/application.config.php.dist';
            }
            application(
                Application::init(
                    Config::application(
                        include $configPath
                    )
                )
            );
            $this->sm = application()->getServiceManager();

            $result = $func();

            application($app);
            $this->sm = $app->getServiceManager();
            return $result;
        } catch (Throwable $e) {
            throw $e;
        } finally {
            $_ENV['WELLCART_APPLICATION_CONTEXT']
                = Application::CONTEXT_SETUP;
            $app->disableMaintenanceMode();
        }
    }

    /**
     * Checks Database Connection
     */
    protected function checkDatabaseConnection()
    {
        /**
         * @var $adapter \Zend\Db\Adapter\Adapter
         */
        $adapter = $this->getDb();
        $mysqlVersion = $adapter->query(
            'SELECT VERSION() AS m_version',
            'execute'
        )->current()['m_version'];
        if ($mysqlVersion) {
            if (preg_match('/^([0-9\.]+)/', $mysqlVersion, $matches)) {
                if (isset($matches[1]) && !empty($matches[1])) {
                    if (version_compare(
                            $matches[1],
                            self::MYSQL_VERSION_REQUIRED
                        ) < 0
                    ) {
                        throw new RuntimeException(
                            'WellCart Engine supports only MySQL version '
                            . self::MYSQL_VERSION_REQUIRED . ' or later.'
                        );
                    }
                }
            }
        }
    }

    /**
     * @return \Zend\Db\Adapter\AdapterInterface
     */
    protected function getDb()
    {
        return $this->sm->get('Zend\Db\Adapter\Adapter');
    }

    /**
     * Run database migrations
     *
     */
    public function updateDatabaseSchema()
    {
        $command = new SchemaMigrationCommand();
        $input = new IgnoreValidationArrayInput(
            ['--configuration' => Config::get('schema-migration.phinx-config')]
        );
        $output = new NullOutput();
        $command->run($input, $output);
    }

    /**
     * Generate proxies
     */
    public function generateProxyClasses()
    {
        if (!isset($_SERVER['argv'])) {
            $_SERVER['argv'] = [null];
        }
        $cli = $this->sm->get('doctrine.cli');
        /**
         * @var $proxiesGenerator GenerateProxiesCommand
         */
        $proxiesGenerator = $cli->get('orm:generate-proxies');

        $input = new IgnoreValidationArrayInput([]);
        $input->ignoreValidationErrors();

        $output = new NullOutput();

        $proxiesGenerator->ignoreValidationErrors();
        $proxiesGenerator->run($input, $output);
    }

    /**
     * Import fixtures
     *
     * @throws Throwable
     */
    public function updateData()
    {
        $command = new Command\ImportFixtureCommand();
        $em = $this->getEntityManager();

        $command->setEntityManager($em);

        $input = new IgnoreValidationArrayInput(
            ['--append' => '']
        );
        $output = new NullOutput();
        $command->run($input, $output);
    }

    /**
     * Refresh superadmin permissions
     */
    public function refreshPermissions()
    {
        $em = $this->getEntityManager();
        $roles = $em->getRepository(
            'WellCart\User\Spec\AclRoleEntity'
        );

        $superAdmin = $roles->findOneBy(['name' => 'superadmin']);
        $permissions = $em->getRepository(
            'WellCart\User\Spec\AclPermissionEntity'
        )->findAll();
        $superAdmin->setPermissions($permissions);
        $em->persist($superAdmin);
        $em->flush($superAdmin);
    }

    /**
     * @return array
     */
    protected function getConfiguration()
    {
        return $this->sm->get('Configuration');
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->sm->get('Doctrine\ORM\EntityManager');
    }

    /**
     * @param array $data
     */
    public function setupWebsiteConfiguration(array $data)
    {
        $this->runInContext(
            Application::CONTEXT_GLOBAL,
            function () use ($data) {
                $editor = $this->getConfigurationEditor();
                $set = [
                    'wellcart.website.name' => Arr::get(
                        $data,
                        'website_name',
                        'Demo Application'
                    ),
                    'router.base_path'      => Arr::get(
                        $data, 'base_path', '/'
                    ),
                ];
                $editor->saveConfigSet($set);
            }
        );

    }

    /**
     * @return ConfigurationEditor
     */
    protected function getConfigurationEditor()
    {
        return $this->sm->get('system_configuration_editor');
    }

    /**
     * Run system upgrade
     *
     * @throws Throwable
     */
    public function upgrade()
    {
        if (!is_file(WELLCART_ROOT . 'config/autoload/installed.php')) {
            throw new RuntimeException(
                'WellCart Platform is not installed yet.'
            );
        }

        try {
            ignore_user_abort(true);
            set_time_limit(0);
            $this->runInContext(
                Application::CONTEXT_GLOBAL,
                function () {
                    $this->checkDatabaseConnection();
                    $this->updateDatabaseSchema();
                    $this->generateProxyClasses();
                    $this->updateData();
                    $this->refreshPermissions();
                }
            );
        } finally {
            ini_restore('max_execution_time');
        }
    }

    public function createInstalledManifest()
    {
        $installedManifest = WELLCART_ROOT . 'config/autoload/installed.php';
        file_put_contents(
            $installedManifest,
            "<?php\n return " . var_export_short(
                ['installation_date' => date('c')],
                true
            ) . ";"
        );

        chmod($installedManifest, 0666);
    }

    /**
     * Publish assets
     */
    public function publishAssets()
    {
        $callback = function () {
            $result = [];
            $config = $this->getConfiguration();
            $resolvedPaths = Arr::get(
                $config,
                'asset_manager.resolver_configs.paths',
                []
            );

            $paths = ['assets' => [], 'themes' => []];
            foreach ($resolvedPaths as $spec) {
                $spec = rtrim(str_replace('\\', '/', realpath($spec)), '/');
                if (substr($spec, -6) == 'public') {
                    if (is_dir($spec . '/assets/')) {
                        $paths['assets'][] = $spec . '/assets/';
                    }
                    if (is_dir($spec . '/themes/')) {
                        $paths['themes'][] = $spec . '/themes/';
                    }
                }
            }

            if (!count($paths)) {
                return $result;
            }

            foreach ($paths as $type => $dirs) {
                $assetsPath = WELLCART_PUBLIC_PATH . $type . DS;
                foreach ($paths[$type] as $modPublic) {
                    $objects = scandir($modPublic);
                    foreach ($objects as $src) {
                        if ($src == '.' || $src == '..') {
                            continue;
                        }
                        $src = $modPublic . $src;
                        list(, $filename) = explode(
                            $type . DS,
                            str_replace('\\', DS, $src)
                        );
                        $destination = $assetsPath . $filename;
                        if ($src != $destination) {
                            if (is_dir($src) && !is_dir($destination)) {
                                symlink($src, $destination);
                                $result[$src] = $destination;
                            }
                        }
                    }
                }
            }
            return $result;
        };

        try {
            ignore_user_abort(true);
            set_time_limit(0);
            return $this->runInContext(
                Application::CONTEXT_GLOBAL,
                $callback
            );
        } finally {
            ini_restore('max_execution_time');
        }
    }

    /**
     * Check system requirements
     *
     * @return array
     */
    public function checkRequirements()
    {
        $requirements = $this->getRequirements();
        foreach ($requirements['PHP Settings'] as $key => &$values) {
            $values['value'] = intval(ini_get($key)) === 1
                ? __('On')
                : __(
                    'Off'
                );

            $values['success'] = $values['value'] === $values['expected'] ? true
                : false;
        }
        foreach ($requirements['PHP Extensions'] as $key => &$values) {
            $values['value'] = extension_loaded($key)
                ? __('Loaded')
                : __(
                    'Not Loaded'
                );
            $values['success'] = $values['value'] === $values['expected'] ? true
                : false;
        }
        foreach ($requirements['File Permissions'] as $key => &$values) {
            $values['value'] = is_writable($key)
                ? __('Writable')
                : __(
                    'Not Writable'
                );
            $values['success'] = $values['value'] === $values['expected'] ? true
                : false;
        }

        return $requirements;
    }

    /**
     * Retrieve requirements
     *
     * @return array
     */
    public function getRequirements()
    {
        $assetsPath = str_replace(WELLCART_ROOT, '', WELLCART_ASSETS_PATH);
        $themesPath = str_replace(WELLCART_ROOT, '', WELLCART_THEMES_PATH);
        $mediaPath = str_replace(WELLCART_ROOT, '', WELLCART_MEDIA_PATH);
        return [
            'Server Capabilities' => [
                'php_version' => [
                    'title'    => __('PHP Version'),
                    'expected' => '>= 7.0.0',
                    'value'    => phpversion(),
                    'success'  => version_compare(phpversion(), '7.0.0', '>=')
                ]
            ],
            'PHP Settings'        => [
                'file_uploads'          => [
                    'title'    => __('File uploads'),
                    'expected' => __('On')
                ],
                'session.auto_start'    => [
                    'title'    => __('Session autostart'),
                    'expected' => __('Off')
                ],
                'session.use_trans_sid' => [
                    'title'    => 'Session use trans SID',
                    'expected' => __('Off')
                ]
            ],
            'PHP Extensions'      => [
                'pdo_mysql' => [
                    'title'    => 'pdo_mysql',
                    'expected' => __('Loaded')
                ],
                'spl'       => [
                    'title'    => 'spl',
                    'expected' => __('Loaded')
                ],
                'ctype'     => [
                    'title'    => 'ctype',
                    'expected' => __('Loaded')
                ],
                'gd'        => [
                    'title'    => 'gd',
                    'expected' => __('Loaded')
                ],
                'curl'      => [
                    'title'    => 'curl',
                    'expected' => __('Loaded')
                ],
                'json'      => [
                    'title'    => 'json',
                    'expected' => __('Loaded')
                ],
                'hash'      => [
                    'title'    => 'hash',
                    'expected' => __('Loaded')
                ],
                'intl'      => [
                    'title'    => 'intl',
                    'expected' => __('Loaded')
                ],
                'dom'       => [
                    'title'    => 'DOM',
                    'expected' => __('Loaded')
                ],
                'xsl'       => [
                    'title'    => 'xsl',
                    'expected' => __('Loaded'),
                ],
                'mbstring'  => [
                    'title'    => 'mbstring',
                    'expected' => __('Loaded'),
                ],
                'simplexml' => [
                    'title'    => 'SimpleXML',
                    'expected' => __('Loaded')
                ],
                'xmlreader' => [
                    'title'    => 'xmlReader',
                    'expected' => __('Loaded')
                ]
            ],
            'File Permissions'    => [
                './config/autoload/' => [
                    'title'    => '/config/autoload',
                    'expected' => __('Writable')
                ],
                './' . $assetsPath   => [
                    'title'    => '/' . $assetsPath,
                    'expected' => __('Writable')
                ],
                './' . $themesPath   => [
                    'title'    => '/' . $themesPath,
                    'expected' => __('Writable')
                ],
                './' . $mediaPath    => [
                    'title'    => '/' . $mediaPath,
                    'expected' => __('Writable')
                ],
                './data/code'        => [
                    'title'    => '/data/code',
                    'expected' => __('Writable')
                ],
                './data/cache'       => [
                    'title'    => '/data/cache',
                    'expected' => __('Writable')
                ],
                './data/logs'        => [
                    'title'    => '/data/logs',
                    'expected' => __('Writable')
                ],
                './data/sessions'    => [
                    'title'    => '/data/sessions',
                    'expected' => __('Writable')
                ],
                './data/upload'      => [
                    'title'    => '/data/upload',
                    'expected' => __('Writable')
                ],
            ]
        ];
    }

    /**
     * Create Admin Account
     *
     * @param array $data
     *
     * @return bool
     * @throws Throwable
     */
    public function createAdminAccount(array $data)
    {
        $data['passwordVerify'] = $data['password'];
        try {
            $this->runInContext(
                'backend',
                function () use ($data) {
                    $userService = $this->getUserService();
                    $em = $this->getEntityManager();
                    $result = $userService->register($data);
                    if (!$result) {
                        throw new \InvalidArgumentException(
                            sprintf(
                                'Admin user registration failed: %s',
                                json_encode(
                                    $userService->getRegisterForm()
                                        ->getMessages()
                                )
                            )
                        );
                    }

                    /**
                     * @var $admin \WellCart\Admin\Spec\AdministratorEntity
                     */
                    $admin = $result;
                    $roles = $em->getRepository(
                        'WellCart\User\Spec\AclRoleEntity'
                    );
                    $admin->addRole($roles->findOneBy(['name' => 'superadmin']))
                        ->addRole($roles->findOneBy(['name' => 'admin']))
                        ->setEmailConfirmationToken(null)
                        ->setPasswordResetToken(null)
                        ->setFailedLoginCount(0);

                    $em->flush($admin);
                }
            );
        } catch (Throwable $e) {
            throw $e;
        }
        return true;
    }

    /**
     * @return mixed
     */
    protected function getUserService()
    {
        return $this->sm->get('zfcuser_user_service');
    }

    protected function getModuleManager()
    {
        return $this->sm->get('ModuleManager');
    }
}
