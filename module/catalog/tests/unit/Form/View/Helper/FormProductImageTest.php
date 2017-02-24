<?php
namespace WellCart\Catalog\Test\Unit\Form\View\Helper;


use WellCart\Catalog\Form\View\Helper\FormProductImage;

class FormProductImageTest extends \WellCart\Test\TestCase
{
    /**
     * @var FormProductImage
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
      parent::setUp();
        $this->object = new FormProductImage;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo   Implement testRender().
     */
    public function testRender()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
