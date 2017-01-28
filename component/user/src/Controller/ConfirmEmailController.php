<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Controller;

use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\User\Service\Registration\AccountEmailHandler;
use WellCart\Utility\Config;

class ConfirmEmailController extends AbstractActionController
{

    /**
     * @var AccountEmailHandler
     */
    protected $handler;

    /**
     * @var bool
     */
    protected $isRecoverPossible = true;

    /**
     * Object constructor
     *
     * @param AccountEmailHandler $service
     */
    public function __construct(AccountEmailHandler $service)
    {
        $this->handler = $service;
    }

    /**
     * Confirm email
     */
    public function confirmAction()
    {
        $token = $this->params()->fromRoute('token');
        if (!($token) || !($this->handler->isValidToken($token))
        ) {
            $this->flashMessenger()
                ->addWarningMessage(
                    $this->__(
                        'This confirmation key is invalid or has expired.'
                    )
                );

            return $this->redirect()->toRoute('zfcuser');
        }

        $user = $this->handler->getRepository()
            ->findOneByEmailConfirmationToken($token);

        try {
            $this->handler->confirmEmail($user);
            $this->flashMessenger()
                ->addSuccessMessage(
                    sprintf(
                        $this->__(
                            'Thank you for registering with %s. Please, log in.'
                        ),
                        Config::get('wellcart.website.name')
                    )
                );

            return $this->redirect()->toRoute('zfcuser');
        } catch (\Throwable $e) {
            $this->getLogger()
                ->emerg($e);
            $this->flashMessenger()
                ->addWarningMessage(
                    $this->__(
                        'An unexpected error occurred. Please try again or contact Customer Support.'
                    )
                );

            return $this->redirect()->toRoute('zfcuser');
        }
    }
}
