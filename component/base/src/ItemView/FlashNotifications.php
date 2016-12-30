<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\ItemView;

use WellCart\Ui\Container\ItemView\AbstractItemView;

class FlashNotifications extends AbstractItemView
{

    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template = 'wellcart-base/item-view/flash-notifications';
}
