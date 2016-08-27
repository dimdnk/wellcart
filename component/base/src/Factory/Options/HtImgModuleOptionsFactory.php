<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Factory\Options;

use HtImgModule\Options\ModuleOptions;
use Interop\Container\ContainerInterface;
use WellCart\Utility\Arr;
use Zend\Stdlib\ArrayUtils;

class HtImgModuleOptionsFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return ModuleOptions
     */
    public function __invoke(ContainerInterface $container): ModuleOptions
    {
        $config = $container->get('Config');
        $options = Arr::merge($config['htimg'], $config['design']['images']);

        $themeManager = $container->get('ZeThemeManager');
        $themeName = $themeManager->getTheme();
        $themeConfig = $themeManager->getThemeConfig($themeName);
        $themeConfig = (!empty($themeConfig['images'])) ?
            $themeConfig['images'] : [];
        $options = Arr::merge($options, $themeConfig);

        return new ModuleOptions($options);
    }
}
