<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CommandBus\Factory;

use Interop\Container\ContainerInterface;
use WellCart\CommandBus\Middleware\DoctrineWrapsMessageHandlingInTransaction;

class DoctrineWrapsMessageHandlingInTransactionFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return DoctrineWrapsMessageHandlingInTransaction
     */
    public function __invoke(ContainerInterface $container
    ): DoctrineWrapsMessageHandlingInTransaction
    {
        $entityManager = $container->get('Doctrine\ORM\EntityManager');

        return new DoctrineWrapsMessageHandlingInTransaction($entityManager);
    }
}
