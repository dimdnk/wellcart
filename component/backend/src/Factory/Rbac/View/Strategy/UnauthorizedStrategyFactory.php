<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\Rbac\View\Strategy;

use Interop\Container\ContainerInterface;
use WellCart\Backend\Rbac\View\Strategy\UnauthorizedStrategy;

class UnauthorizedStrategyFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return UnauthorizedStrategy
     */
    public function __invoke(ContainerInterface $container
    ): UnauthorizedStrategy {
        /* @var \ZfcRbac\Options\ModuleOptions $moduleOptions */
        $moduleOptions = $container->get('ZfcRbac\Options\ModuleOptions');

        return new UnauthorizedStrategy(
            $moduleOptions->getUnauthorizedStrategy(),
            $container->get('WellCart\Ui\Layout\Updater\LayoutUpdaterInterface')
        );
    }
}
