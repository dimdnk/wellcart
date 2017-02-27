<?php

namespace WellCart\Catalog\Test\Unit\ItemView\Backend;

use WellCart\Catalog\ItemView\Backend\BrandThumbnail;

class BrandThumbnailTest extends \WellCart\Test\TestCase
{

    /**
     * @var BrandThumbnail
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new BrandThumbnail();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
