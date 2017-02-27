<?php

namespace WellCart\Directory\Test\Unit\Factory\Controller\Backend;

use WellCart\Directory\Controller\Backend\ZonesController;
use WellCart\Directory\Factory\Controller\Backend\ZonesControllerFactory;

class ZonesControllerFactoryTest extends \WellCart\Test\TestCase
{

    /**
     * @var ZonesControllerFactory
     */
    protected $object;

    public function testInvoke()
    {
        $this->assertInstanceOf(ZonesController::class,
            $this->object->__invoke($this->container->get('ControllerManager')));
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new ZonesControllerFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
