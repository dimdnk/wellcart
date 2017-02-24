<?php
namespace WellCart\Catalog\Test\Unit\Form\Element;

use WellCart\Catalog\Form\Element\ProductImage;

class ProductImageTest extends \WellCart\Test\TestCase
{
    /**
     * @var ProductImage
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
      parent::setUp();
        $this->object = new ProductImage;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo   Implement testGetObject().
     */
    public function testGetObject()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
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
