<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\ItemView;

use PHPUnit\Framework\TestCase;

class HtmlHeadTest extends TestCase
{
    /**
     * @var HtmlHead
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()->get('BlockManager')
            ->get(HtmlHead::class);
    }

    public function testInit()
    {
        $this->assertNull($this->object->init());
    }
}
