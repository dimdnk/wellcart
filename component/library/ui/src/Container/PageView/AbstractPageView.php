<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Container\PageView;

use WellCart\Ui\Container\ItemView\AbstractItemView;
use WellCart\Ui\Container\PageViewInterface;
use WellCart\Ui\Layout\LayoutManagerAwareInterface;
use WellCart\Ui\Layout\LayoutManagerAwareTrait;

abstract class AbstractPageView
    extends AbstractItemView
    implements
    PageViewInterface,
    LayoutManagerAwareInterface
{
    use LayoutManagerAwareTrait;

}