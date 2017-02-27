<?php

namespace WellCart\Catalog\Test\Unit\Hydrator;


use WellCart\Catalog\Hydrator\BrandHydrator;

class BrandHydratorTest extends \WellCart\Test\TestCase
{

    /**
     * @var BrandHydrator
     */
    protected $object;

    /**
     * @todo   Implement testHydrate().
     */
    public function testHydrate()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new BrandHydrator($this->container->get('Doctrine\ORM\EntityManager'));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
