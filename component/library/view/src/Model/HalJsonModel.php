<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\View\Model;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use ZF\Hal\View\HalJsonModel as Model;

class HalJsonModel extends Model implements
    EventManagerAwareInterface
{
    use EventManagerAwareTrait;
}