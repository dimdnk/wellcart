<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository as TreeRepository;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

abstract class NestedTreeRepository
    extends TreeRepository implements EventManagerAwareInterface
{
    use EventManagerAwareTrait, EventDrivenRepositoryTrait;


}