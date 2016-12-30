<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM;

use Doctrine\ORM\EntityRepository;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

abstract class AbstractRepository
    extends EntityRepository
    implements EventManagerAwareInterface, Repository
{
    use EventManagerAwareTrait, EventDrivenRepositoryTrait;

    /**
     * @return QueryBuilder
     */
    abstract public function finder();


}