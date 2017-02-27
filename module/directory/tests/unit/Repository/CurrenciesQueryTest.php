<?php

namespace WellCart\Directory\Test\Unit\Repository;

use WellCart\Directory\Repository\CurrenciesQuery;

class CurrenciesQueryTest extends \WellCart\Test\TestCase
{

    /**
     * @var CurrenciesQuery
     */
    protected $object;

    /**
     * @todo   Implement testEnabled().
     */
    public function testEnabled()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @todo   Implement testDisabled().
     */
    public function testDisabled()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @todo   Implement testPrimary().
     */
    public function testPrimary()
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
        $this->object = new CurrenciesQuery($this->container->get('Doctrine\ORM\EntityManager'));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
