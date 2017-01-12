<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use PHPUnit\Framework\TestCase;

/**
 * Debug helper test.
 *
 */
class DebugTest extends TestCase
{

    public function testDump()
    {
        Debug::dump([10 => 100, 'x' => 'y']);
        $output = ob_get_contents();
        ob_clean();
        $this->assertEquals("", $output);
    }
}