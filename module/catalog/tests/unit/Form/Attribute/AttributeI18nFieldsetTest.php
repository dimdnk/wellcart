<?php
namespace WellCart\Catalog\Test\Unit\Form\Attribute;

use WellCart\Catalog\Form\Attribute\AttributeI18nFieldset;

class AttributeI18nFieldsetTest extends \WellCart\Test\TestCase
{
    /**
     * @var AttributeI18nFieldset
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
      parent::setUp();
        $this->object = new AttributeI18nFieldset;
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
