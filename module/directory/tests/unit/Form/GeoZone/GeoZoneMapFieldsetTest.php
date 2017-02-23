<?php
namespace WellCart\Directory\Test\Unit\Form\GeoZone;

use WellCart\Directory\Form\GeoZone\GeoZoneMapFieldset;

class GeoZoneMapFieldsetTest extends \WellCart\Test\TestCase
{
    /**
     * @var GeoZoneMapFieldset
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
      parent::setUp();
        $this->object = new GeoZoneMapFieldset;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo   Implement testSetObject().
     */
    public function testSetObject()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
