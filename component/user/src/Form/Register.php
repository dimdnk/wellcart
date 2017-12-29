<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Form;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\SharedEventManager;

class Register extends \ZfcUser\Form\Register
{
  /**
   * Retrieve the event manager
   *
   * Lazy-loads an EventManager instance if none registered.
   *
   * @return EventManagerInterface
   */
  public function getEventManager()
  {
    if (!$this->events instanceof EventManagerInterface) {
      $this->setEventManager(new EventManager(new SharedEventManager()));
    }
    return $this->events;
  }
}
