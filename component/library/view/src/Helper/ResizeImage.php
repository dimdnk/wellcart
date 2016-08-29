<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Helper;

use TckImageResizer\View\Helper\Resize;

class ResizeImage extends Resize
{
    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return str_replace('processed/', 'media/', parent::__toString());
    }
}