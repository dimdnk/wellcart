<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Console\Command;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use DoctrineDataFixtureModule\Command\FixturesLoadCommand;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WellCart\Setup\DataFixture\Loader;
use WellCart\Setup\DataFixture\PermissionsLoader;

class ImportFixtureCommand extends FixturesLoadCommand
{
  /**
   * @var ContainerInterface
   */
  protected $container;
  public function __construct(ContainerInterface $container)
  {
    parent::__construct($container);
    $this->container = $container;
  }


  public function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->container->get('doctrine.entitymanager.orm_default');
        $loader = new Loader($em);
        $purger = new ORMPurger($em);

        if ($input->getOption('purge-with-truncate')) {
            $purger->setPurgeMode(self::PURGE_MODE_TRUNCATE);
        }

        $fixtures = $loader->getFixtures();
        if (empty($fixtures)) {
            return;
        }

        $executor = new ORMExecutor($em, $purger);
        $executor->execute($fixtures, $input->getOption('append'));

        $permissionsLoader = new PermissionsLoader($em);
        $permissionsLoader->load($fixtures);
    }
}
