<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Helper;

use WellCart\Utility\Config;

class ThemePath extends \Zend\View\Helper\BasePath
{

    /**
     * @inheritdoc
     */
    public function __invoke($file = null)
    {
        $this->basePath = Config::get(
            'public_resources.themes.base_path',
            Config::get('view_manager.base_path') . 'themes'
        );

        return parent::__invoke($file);
    }
}