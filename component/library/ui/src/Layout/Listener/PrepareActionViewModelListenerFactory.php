<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Layout\Listener;

use ConLayout\Block\BlockPoolInterface;
use Interop\Container\ContainerInterface;

class PrepareActionViewModelListenerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return PrepareActionViewModelListener
     */
    public function __invoke(ContainerInterface $container
    ): PrepareActionViewModelListener
    {
        return new PrepareActionViewModelListener(
            $container->get(BlockPoolInterface::class)
        );
    }
}
