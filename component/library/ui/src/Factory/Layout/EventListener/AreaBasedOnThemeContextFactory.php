<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Factory\Layout\EventListener;

use WellCart\Ui\Layout\Updater\LayoutUpdaterInterface;
use Interop\Container\ContainerInterface;
use WellCart\Ui\Layout\EventListener\AreaBasedOnThemeContext;

class AreaBasedOnThemeContextFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return AreaBasedOnThemeContext
     */
    public function __invoke(ContainerInterface $container
    ): AreaBasedOnThemeContext {
        return new AreaBasedOnThemeContext(
            $container->get(LayoutUpdaterInterface::class),
            $container->get('WellCart\Ui\Theme\Manager')
        );
    }
}
