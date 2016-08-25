<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\ItemView;

use WellCart\Ui\Container\ItemView\AbstractItemView;
use WellCart\Utility\Config;
use Zend\Stdlib\InitializableInterface;

/**
 * Brand menu bar
 */
class TopBranding extends AbstractItemView implements InitializableInterface
{

    /**
     * Template to use when rendering this model
     *
     * @var string
     */
    protected $template = 'wellcart-admin/item-view/top-branding';

    /**
     * Initialize view item variables
     *
     * @return void
     */
    public function init()
    {
        $websiteTitle = Config::get('wellcart.website.name', __('Demo Application'));
        $this->setVariables(compact('websiteTitle'));
    }
}
