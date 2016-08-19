<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM;

use Gedmo\Translatable\Entity\Repository\TranslationRepository as Repository;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

abstract class TranslatableRepository
    extends Repository implements EventManagerAwareInterface
{
    use EventManagerAwareTrait, EventDrivenRepositoryTrait;
}