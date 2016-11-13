<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\ORM\EntityManager;
use WellCart\ModuleManager\Feature\DataFixturesProviderInterface;
use WellCart\Setup\Exception\BadMethodCallException;

class Loader extends
    \Doctrine\Common\DataFixtures\Loader
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $connection;
    /**
     * @var bool
     */
    protected $isLoaded = false;

    /**
     * Loader constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->connection = $em->getConnection();
    }

    /**
     * @inheritdoc
     */
    public function loadFromDirectory($dir)
    {
        throw new BadMethodCallException(
            sprintf('Method %s  not supported.', __METHOD__)
        );
    }

    /**
     * @inheritdoc
     */
    public function getFixtures()
    {
        if (!$this->isLoaded) {
            $this->loadFromModules();
        }
        return parent::getFixtures();
    }

    /**
     * @inheritdoc
     */
    public function addFixture(FixtureInterface $fixture)
    {
        if ($this->validFixture($fixture)) {
            return parent::addFixture($fixture);
        }
    }

    /**
     * Load data fixtures form application modules
     */
    final protected function loadFromModules()
    {
        if (function_exists('application')
            && $app = application()
        ) {
            $modules = $app->getServiceManager()
                ->get('ModuleManager')
                ->getLoadedModules();

            foreach ($modules as $module) {
                if (!$module instanceof DataFixturesProviderInterface) {
                    continue;
                }
                $dataFixtures = (array)$module->getDataFixtures();
                foreach ($dataFixtures as $id => $dataFixture) {
                    if ($dataFixture instanceof SetupDataFixtureInterface) {
                        $this->addFixture($dataFixture);
                    }
                }
            }
        }
    }

    /**
     * @param FixtureInterface $fixture
     *
     * @return bool
     */
    protected function validFixture(FixtureInterface $fixture)
    {
        if (!$fixture instanceof SetupDataFixtureInterface) {
            return false;
        }

        $dataFixtureName = str_replace('\\', '', get_class($fixture));
        $version = $fixture->getOrder();
        $exist = $this->connection->fetchColumn(
            'SELECT version FROM setup_data_migration WHERE version = ?',
            [$version]
        );
        if ($exist) {
            return false;
        }
        $this->connection->insert(
            'setup_data_migration',
            [
                'version'        => $version,
                'migration_name' => $dataFixtureName,
            ]
        );
        return true;
    }
}
