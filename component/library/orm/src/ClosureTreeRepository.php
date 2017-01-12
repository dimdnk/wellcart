<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Tree\Entity\Repository\ClosureTreeRepository as Repository;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

abstract class ClosureTreeRepository
    extends Repository implements EventManagerAwareInterface
{

    use EventManagerAwareTrait, EventDrivenRepositoryTrait;

    /**
     * @inheritDoc
     */
    public function __construct(EntityManager $em, ClassMetadata $class)
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

}