<?php

namespace WellCart\Catalog\Test\Unit\Repository;


use WellCart\Catalog\Repository\ProductI18nQuery;

class ProductI18nQueryTest extends \WellCart\Test\TestCase
{

    /**
     * @var ProductI18nQuery
     */
    protected $object;

    /**
     * @todo   Implement testFilterByLanguage().
     */
    public function testFilterByLanguage()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @todo   Implement testWithVariants().
     */
    public function testWithVariants()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @todo   Implement testWithProduct().
     */
    public function testWithProduct()
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
        $this->object = new ProductI18nQuery($this->container->get('Doctrine\ORM\EntityManager'));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
