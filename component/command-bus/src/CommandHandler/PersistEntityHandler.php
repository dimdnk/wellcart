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
use WellCart\CommandBus\Command\PersistEntity;
use WellCart\ORM\Entity;

class PersistEntityHandler implements ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    public function handle(PersistEntity $command): Entity
    {
        $entity = $command->getEntity();
        $this->getObjectManager()->persist($entity);
        return $entity;
    }
}
