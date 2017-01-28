<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Container\LayoutView;

class Root extends LayoutView
{

    /**
     * @inheritdoc
     */
    public function setRootView(Root $layout)
    {
        $this->layout = $this;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRootView()
    {
        return $this;
    }
}