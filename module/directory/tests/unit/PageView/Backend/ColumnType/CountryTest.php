<?php

namespace WellCart\Directory\Test\Unit\PageView\Backend\ColumnType;

use WellCart\Directory\PageView\Backend\ColumnType\Country;

class CountryTest extends \WellCart\Test\TestCase
{

    /**
     * @var Country
     */
    protected $object;

    /**
     * @todo   Implement testGetUserValue().
     */
    public function testGetUserValue()
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
        $this->object = new Country;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}