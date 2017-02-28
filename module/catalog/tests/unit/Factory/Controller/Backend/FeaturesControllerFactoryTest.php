<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Catalog\Test\Unit\Factory\Controller\Backend;

use WellCart\Catalog\Controller\Backend\FeaturesController;
use WellCart\Catalog\Factory\Controller\Backend\FeaturesControllerFactory;

class FeaturesControllerFactoryTest extends \WellCart\Test\TestCase
{

    /**
     * @var FeaturesControllerFactory
     */
    protected $object;


    public function testInvoke()
    {
        $this->assertInstanceOf(FeaturesController::class,
            $this->object->__invoke($this->container->get('ControllerManager')));
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new FeaturesControllerFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
