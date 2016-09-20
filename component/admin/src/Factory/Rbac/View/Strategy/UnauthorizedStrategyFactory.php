<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Factory\Rbac\View\Strategy;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Rbac\View\Strategy\UnauthorizedStrategy;

class UnauthorizedStrategyFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return UnauthorizedStrategy
     */
    public function __invoke(ContainerInterface $container
    ): UnauthorizedStrategy
    {
        /* @var \ZfcRbac\Options\ModuleOptions $moduleOptions */
        $moduleOptions = $container->get('ZfcRbac\Options\ModuleOptions');

        return new UnauthorizedStrategy(
            $moduleOptions->getUnauthorizedStrategy(),
            $container->get('ConLayout\Updater\LayoutUpdaterInterface')
        );
    }
}
