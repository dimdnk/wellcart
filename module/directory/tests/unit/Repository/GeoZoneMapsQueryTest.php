<?php

namespace WellCart\Directory\Test\Unit\Repository;

use WellCart\Directory\Repository\GeoZoneMapsQuery;

class GeoZoneMapsQueryTest extends \WellCart\Test\TestCase
{

    /**
     * @var GeoZoneMapsQuery
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new GeoZoneMapsQuery;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
