<?php

namespace WellCart\Catalog\Test\Unit\PageView\Backend\CategriesGrid;

use WellCart\Catalog\PageView\Backend\CategriesGrid\NameFormatter;

class NameFormatterTest extends \WellCart\Test\TestCase
{

    /**
     * @var NameFormatter
     */
    protected $object;

    /**
     * @todo   Implement testGetFormattedValue().
     */
    public function testGetFormattedValue()
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
        $this->object = new NameFormatter;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
