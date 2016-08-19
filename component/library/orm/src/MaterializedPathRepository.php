<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM;

use Gedmo\Tree\Entity\Repository\MaterializedPathRepository as Repository;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

abstract class MaterializedPathRepository
    extends Repository implements EventManagerAwareInterface
{
    use EventManagerAwareTrait, EventDrivenRepositoryTrait;
}