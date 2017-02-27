<?php

namespace WellCart\Catalog\Test\Unit\Repository;

use WellCart\Catalog\Repository\AttributeValuesQuery;

class AttributeValuesQueryTest extends \WellCart\Test\TestCase
{

    /**
     * @var AttributeValuesQuery
     */
    protected $object;

    /**
     * @todo   Implement testDefaultSortOrder().
     */
    public function testDefaultSortOrder()
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
        $this->object = new AttributeValuesQuery($this->container->get('Doctrine\ORM\EntityManager'));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
