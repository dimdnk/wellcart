<?php

namespace WellCart\Catalog\Test\Unit\Factory\Controller\Backend;

use WellCart\Catalog\Controller\Backend\ProductTemplatesController;
use WellCart\Catalog\Factory\Controller\Backend\ProductTemplatesControllerFactory;

class ProductTemplatesControllerFactoryTest extends \WellCart\Test\TestCase
{

    /**
     * @var ProductTemplatesControllerFactory
     */
    protected $object;

    /**
     * @todo   Implement testInvoke().
     */
    public function testInvoke()
    {
        $this->assertInstanceOf(ProductTemplatesController::class,
            $this->object->__invoke($this->container->get('ControllerManager')));
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new ProductTemplatesControllerFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
