<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Layout\Listener;

use Interop\Container\ContainerInterface;

class AreaBasedOnThemeContextFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return AreaBasedOnThemeContext
     */
    public function __invoke(ContainerInterface $container
    ): AreaBasedOnThemeContext
    {
        return new AreaBasedOnThemeContext(
            $container->get('ConLayout\Updater\LayoutUpdaterInterface'),
            $container->get('ZeThemeManager')
        );
    }
}
