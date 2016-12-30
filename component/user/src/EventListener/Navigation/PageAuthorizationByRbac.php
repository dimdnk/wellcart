<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener\Navigation;

use Zend\EventManager\EventInterface;
use Zend\Navigation\Page\AbstractPage;
use ZfcRbac\Service\AuthorizationServiceInterface;

class PageAuthorizationByRbac
{
    /**
     * @var AuthorizationServiceInterface
     */
    protected $authorizationService;

    /**
     * @param AuthorizationServiceInterface $authorizationService
     */
    public function __construct(AuthorizationServiceInterface $authorizationService
    ) {
        $this->authorizationService = $authorizationService;
    }

    /**
     * @param  EventInterface $event
     *
     * @return bool|void
     */
    public function accept(EventInterface $event)
    {
        $page = $event->getParam('page');

        if (!$page instanceof AbstractPage) {
            return;
        }

        $permission = $page->getPermission();

        if (is_null($permission)) {
            $event->stopPropagation();
            return true;
        }

        $event->stopPropagation();

        return $this->authorizationService->isGranted($permission);
    }
}
