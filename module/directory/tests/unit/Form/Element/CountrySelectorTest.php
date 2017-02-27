<?php

namespace WellCart\Directory\Test\Unit\Form\Element;

use WellCart\Directory\Form\Element\CountrySelector;

class CountrySelectorTest extends \WellCart\Test\TestCase
{

    /**
     * @var CountrySelector
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new CountrySelector;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
