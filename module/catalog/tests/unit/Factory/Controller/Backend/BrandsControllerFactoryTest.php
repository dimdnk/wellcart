<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Catalog\Test\Unit\Factory\Controller\Backend;


use WellCart\Catalog\Controller\Backend\BrandsController;
use WellCart\Catalog\Factory\Controller\Backend\BrandsControllerFactory;

class BrandsControllerFactoryTest extends \WellCart\Test\TestCase
{

    /**
     * @var BrandsControllerFactory
     */
    protected $object;


    public function testInvoke()
    {
        $this->assertInstanceOf(BrandsController::class,
            $this->object->__invoke($this->container->get('ControllerManager')));
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new BrandsControllerFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
