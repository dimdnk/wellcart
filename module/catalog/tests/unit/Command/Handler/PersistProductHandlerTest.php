<?php
namespace WellCart\Catalog\Test\Unit\Command\Handler;

use WellCart\Catalog\Command\Handler\PersistProductHandler;

class PersistProductHandlerTest extends \WellCart\Test\TestCase
{
    /**
     * @var PersistProductHandler
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
      parent::setUp();
        $this->object = new PersistProductHandler;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo   Implement testHandle().
     */
    public function testHandle()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
