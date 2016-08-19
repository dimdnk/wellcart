<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\Middleware;

use Doctrine\ORM\EntityManagerInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

class DoctrineWrapsMessageHandlingInTransaction implements MessageBusMiddleware
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param object   $message
     * @param callable $next
     */
    public function handle($message, callable $next)
    {
        $this->entityManager->transactional(
            function () use ($message, $next) {
                $next($message);
            }
        );
    }
}
