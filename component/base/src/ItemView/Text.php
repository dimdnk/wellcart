<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\ItemView;

use WellCart\Ui\Container\ItemView\ItemView;

class Text extends ItemView
{
    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template = 'item-view/text';
    /**
     * @var string
     */
    protected $text = '';

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Text
     */
    public function setText(string $text): Text
    {
        $this->text = $text;
        return $this;
    }
}
