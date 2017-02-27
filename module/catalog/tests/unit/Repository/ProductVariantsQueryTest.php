<?php

namespace WellCart\Catalog\Test\Unit\Repository;


use WellCart\Catalog\Repository\ProductVariantsQuery;

class ProductVariantsQueryTest extends \WellCart\Test\TestCase
{

    /**
     * @var ProductVariantsQuery
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new ProductVariantsQuery;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
