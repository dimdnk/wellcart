<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Test\Factory;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;

abstract class FactoryTestCase extends TestCase
{
  /**
   * @var ContainerInterface
   */
  protected $container;

  /**
   * Sets up the fixture, for example, open a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    parent::setUp();
    $this->container = application()->getServiceManager();
  }
}