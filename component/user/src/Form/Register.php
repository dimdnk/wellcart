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
use ZfcUser\Options\RegistrationOptionsInterface;

class Register extends \ZfcUser\Form\Register
{
  public function __construct(?string $name,
    RegistrationOptionsInterface $options
  ) {
    parent::__construct($name, $options);
    $this->add(
      [
        'name'       => 'first_name',
        'type'       => 'Text',
        'options'    => [
          'label' => __('First Name'),
        ],
        'attributes' => [
          'autocomplete' => 'off',
        ],
      ]
    );

    $this->add(
      [
        'name'       => 'last_name',
        'type'       => 'Text',
        'options'    => [
          'label' => __('Last Name'),
        ],
        'attributes' => [
          'autocomplete' => 'off',
        ],
      ]
    );
  }


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
