<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Repository;

use PHPUnit\Framework\TestCase;
use WellCart\CMS\Spec\PageRepository;

class PagesQueryTest extends TestCase
{
    /**
     * @var PagesQuery
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(
                PageRepository::class
            )->finder();
    }

    public function testVisible()
    {
        $this->assertInstanceOf(
            PagesQuery::class,
            $this->object->visible()
        );
    }

    public function testHidden()
    {
        $this->assertInstanceOf(
            PagesQuery::class,
            $this->object->hidden()
        );
    }
}
