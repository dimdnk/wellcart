<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types=1);

namespace WellCart\Catalog\Test\Unit\Repository;

use WellCart\Catalog\Repository\ProductTemplateI18n;
use WellCart\Catalog\Repository\ProductTemplateI18nQuery;

class ProductTemplateI18nQueryTest extends \WellCart\Test\TestCase
{

    /**
     * @var ProductTemplateI18nQuery
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
     * @todo   Implement testWithProductTemplate().
     */
    public function testWithProductTemplate()
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
        $this->object = $this->container->get(ProductTemplateI18n::class)->finder();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
}
