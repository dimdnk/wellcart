<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Ui\Theme;

use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use ZeTheme\Manager as AbstractManager;

class Manager extends AbstractManager
{

    /**
     * Get a theme configuration file
     *
     * @param string $theme
     *
     * @return array
     */
    public function getThemeConfig($theme)
    {
        $result = [];
        $config = Config::get('design.theme.' . $theme, []);
        if (is_array($config)) {
            $result = [];
            if (!empty($config['parent'])) {
                $parent = $config['parent'];
                $parent = $this->cleanThemeName($parent);
                $parentConfig = $this->getThemeConfig($parent);

                if ($parentConfig !== null) {
                    unset($parentConfig['parent']);
                }
            }

            if (!empty($parentConfig)) {
                $result = Arr::merge($result, $parentConfig);
            }

            $result = Arr::merge($result, $config);

            if (!empty($result['parent'])) {
                unset($result['parent']);
            }
        }

        return $result;
    }
}