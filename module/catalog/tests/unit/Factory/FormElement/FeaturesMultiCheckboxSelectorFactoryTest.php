<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Catalog\Test\Unit\Factory\FormElement;


use WellCart\Catalog\Factory\FormElement\FeaturesMultiCheckboxSelectorFactory;

class FeaturesMultiCheckboxSelectorFactoryTest extends \WellCart\Test\TestCase
{

    /**
     * @var FeaturesMultiCheckboxSelectorFactory
     */
    protected $object;

    /**
     * @todo   Implement testInvoke().
     */
    public function testInvoke()
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
        $this->object = new FeaturesMultiCheckboxSelectorFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
