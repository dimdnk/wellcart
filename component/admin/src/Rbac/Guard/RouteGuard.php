<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Rbac\Guard;

use Zend\Mvc\MvcEvent;
use ZfcRbac\Exception\UnauthorizedException;
use ZfcRbac\Service\RoleService;

class RouteGuard
  extends \ZfcRbac\Guard\RouteGuard
{
  public function __construct(RoleService $roleService, array $rules)
  {
    parent::__construct($roleService, $rules);
  }

  /**
   * @private
   * @param  MvcEvent $event
   * @return void
   */
  public function onResult(MvcEvent $event)
  {
    if ($this->isGranted($event)) {
      return;
    }

    $event->setError(self::GUARD_UNAUTHORIZED);
    $event->setParam('exception', new UnauthorizedException(
      'You are not authorized to access this resource',
      403
    ));

    $event->stopPropagation(true);
    $application  = $event->getApplication();
    $eventManager = $application->getEventManager();
    $eventManager->trigger(MvcEvent::EVENT_DISPATCH_ERROR, $event);
  }
}
