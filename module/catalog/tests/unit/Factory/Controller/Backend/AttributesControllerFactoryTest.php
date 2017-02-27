<?php

namespace WellCart\Catalog\Test\Unit\Factory\Controller\Backend;

use WellCart\Catalog\Controller\Backend\AttributesController;
use WellCart\Catalog\Factory\Controller\Backend\AttributesControllerFactory;

class AttributesControllerFactoryTest extends \WellCart\Test\TestCase
{

    /**
     * @var AttributesControllerFactory
     */
    protected $object;

    public function testInvoke()
    {
        $this->assertInstanceOf(AttributesController::class,
            $this->object->__invoke($this->container->get('ControllerManager')));
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new AttributesControllerFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
