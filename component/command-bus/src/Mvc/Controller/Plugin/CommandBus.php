<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\Mvc\Controller\Plugin;

use SimpleBus\Message\Bus\Middleware\MessageBusSupportingMiddleware;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CommandBus extends AbstractPlugin
{
    /**
     * @var MessageBusSupportingMiddleware
     */
    private $commandBus;

    /**
     * CommandBus constructor.
     *
     * @param MessageBusSupportingMiddleware $commandBus
     */
    public function __construct(MessageBusSupportingMiddleware $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @return MessageBusSupportingMiddleware
     */
    public function __invoke(): MessageBusSupportingMiddleware
    {
        return $this->getCommandBus();
    }

    /**
     * @return MessageBusSupportingMiddleware
     */
    public function getCommandBus(): MessageBusSupportingMiddleware
    {
        return $this->commandBus;
    }
}
