<?php

namespace WellCart\Catalog\Test\Unit\Repository;

use WellCart\Catalog\Repository\CategoryI18nQuery;

class CategoryI18nQueryTest extends \WellCart\Test\TestCase
{

    /**
     * @var CategoryI18nQuery
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
     * @todo   Implement testSortByCategory().
     */
    public function testSortByCategory()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @todo   Implement testExcludeRoot().
     */
    public function testExcludeRoot()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @todo   Implement testWithCategory().
     */
    public function testWithCategory()
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
        $this->object = new CategoryI18nQuery($this->container->get('Doctrine\ORM\EntityManager'));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
