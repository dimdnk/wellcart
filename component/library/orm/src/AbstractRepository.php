<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\ORM;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

abstract class AbstractRepository
    extends EntityRepository
    implements EventManagerAwareInterface, Repository
{

    use EventManagerAwareTrait, EventDrivenRepositoryTrait;

    /**
     * @inheritDoc
     */
    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->getEventManager()
            ->setIdentifiers(
                [
                    __CLASS__,
                    get_class($this),
                ]
            );
    }


    /**
     * @return QueryBuilder
     */
    abstract public function finder();


}