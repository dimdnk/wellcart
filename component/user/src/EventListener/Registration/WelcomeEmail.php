<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\EventListener\Registration;

use WellCart\User\Service\Registration\AccountEmailHandler;
use Zend\EventManager\EventInterface;

class WelcomeEmail
{

    /**
     * @var AccountEmailHandler
     */
    protected $handler;

    public function __construct(AccountEmailHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param EventInterface $e
     *
     * @return bool
     */
    public function __invoke(EventInterface $e)
    {
        /* @var $user \WellCart\User\Spec\UserEntity */
        $user = $e->getParam('user');
        if ($this->handler->isSendWelcomeEmail()) {
            $this->handler->sendWelcomeEmail($user);
        }
        return true;
    }
}
