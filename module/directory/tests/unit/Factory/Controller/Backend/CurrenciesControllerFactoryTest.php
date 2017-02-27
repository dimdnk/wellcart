<?php

namespace WellCart\Directory\Test\Unit\Factory\Controller\Backend;


use WellCart\Directory\Controller\Backend\CurrenciesController;
use WellCart\Directory\Factory\Controller\Backend\CurrenciesControllerFactory;

class CurrenciesControllerFactoryTest extends \WellCart\Test\TestCase
{

    /**
     * @var CurrenciesControllerFactory
     */
    protected $object;

    public function testInvoke()
    {
        $this->assertInstanceOf(CurrenciesController::class,
            $this->object->__invoke($this->container->get('ControllerManager')));
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new CurrenciesControllerFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
