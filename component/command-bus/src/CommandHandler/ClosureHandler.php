<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\CommandHandler;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;

class ClosureHandler implements ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    public function handle(\Closure $command)
    {
        return $command($this->getObjectManager());
    }
}
