<?php
namespace WellCart\Directory\Test\Unit\Repository\Helper;

use WellCart\Directory\Repository\Helper\CurrencyConverter;

class CurrencyConverterTest extends \WellCart\Test\TestCase
{
    /**
     * @var CurrencyConverter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
      parent::setUp();
        $this->object = new CurrencyConverter;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo   Implement testConvert().
     */
    public function testConvert()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
