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

class TextTest extends TestCase
{

    /**
     * @var Text
     */
    private $object;

    public function setUp()
    {
        $this->object = application()
            ->getServiceManager()
            ->get(Text::class);
    }

    public function testSetText()
    {
        $this->object->setText('Demo Text');
        $this->assertEquals('Demo Text', $this->object->getText());
    }

    public function testGetText()
    {
        $this->assertEquals('', $this->object->getText());
    }
}
