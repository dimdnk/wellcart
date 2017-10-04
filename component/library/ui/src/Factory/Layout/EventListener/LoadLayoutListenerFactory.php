<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Ui\Factory\Layout\EventListener;

use WellCart\Ui\Layout\Layout\LayoutInterface;
use Interop\Container\ContainerInterface;
use WellCart\Ui\Layout\EventListener\LoadLayoutListener;

class LoadLayoutListenerFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return LoadLayoutListener
     */
    public function __invoke(ContainerInterface $container
    ): LoadLayoutListener {
        return new LoadLayoutListener($container->get(LayoutInterface::class));
    }
}
