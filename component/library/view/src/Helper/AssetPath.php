<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\View\Helper;

use WellCart\Utility\Config;

class AssetPath extends \Zend\View\Helper\BasePath
{

    /**
     * @inheritdoc
     */
    public function __invoke($file = null)
    {
        $this->basePath = Config::get(
            'public_resources.assets.base_path',
            Config::get('view_manager.base_path') . 'assets'
        );

        return parent::__invoke($file);
    }
}