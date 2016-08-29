<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Factory\Layout\Listener;

use ConLayout\Layout\LayoutInterface;
use Interop\Container\ContainerInterface;
use WellCart\Ui\Layout\Listener\LoadLayoutListener;

class LoadLayoutListenerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return LoadLayoutListener
     */
    public function __invoke(ContainerInterface $container
    ): LoadLayoutListener
    {
        return new LoadLayoutListener($container->get(LayoutInterface::class));
    }
}