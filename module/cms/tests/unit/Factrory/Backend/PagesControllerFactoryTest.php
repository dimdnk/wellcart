<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\CMS\Test\Unit\Factory\Controller\Backend;

use WellCart\CMS\Controller\Backend\PagesController;
use WellCart\CMS\Factory\Controller\Backend\PagesControllerFactory;
use WellCart\Test\Factory\FactoryTestCase;

class PagesControllerFactoryTest extends FactoryTestCase
{
  /**
   * @var PagesControllerFactory
   */
  private $object;

  public function setUp()
  {
    parent::setUp();
    $this->object = new PagesControllerFactory();
  }

  public function testInvoke()
  {
    $this->assertInstanceOf(PagesController::class,
      $this->object->__invoke($this->container->get('ControllerManager'))
    );
  }
}