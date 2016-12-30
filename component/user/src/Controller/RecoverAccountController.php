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
use WellCart\User\Service\RecoverAccount as RecoverAccountService;
use Zend\Http\PhpEnvironment\Request;

class RecoverAccountController extends AbstractActionController
{

    /**
     * @var RecoverAccountService
     */
    protected $service;

    /**
     * @var bool
     */
    protected $isRecoverPossible = true;

    /**
     * Object constructor
     *
     * @param RecoverAccountService $service
     */
    public function __construct(RecoverAccountService $service)
    {
        $this->service = $service;
        $this->isRecoverPossible = $this->service->isRecoverPossible();
    }

    /**
     * Init password reset
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function initiateAction()
    {
        $isRecoverPossible = $this->isRecoverPossible;
        $form = $this->service->getRecoverAccountForm();
        /**
         * @var $request Request
         */
        $request = $this->getRequest();

        if ($isRecoverPossible && $request->isPost()) {
            $form->setData($request->getPost($form->getName(), []));
            if ($form->isValid()) {
                try {
                    $this->service->initiate(
                        $form
                            ->get('email')
                            ->getValue(),
                        'user-account-recovery/reset'
                    );
                    $this->flashMessenger()
                        ->addSuccessMessage(
                            $this->__(
                                "If your email address exists in our database, you will receive a password recovery link at your email address in a few minutes."
                            )
                        );
                    return $this->redirect()->toRoute('zfcuser');
                } catch (\Throwable $e) {
                    $this->getLogger()
                        ->emerg($e->getMessage());
                    $this->flashMessenger()
                        ->addWarningMessage(
                            $this->__(
                                'An unexpected error occurred. Please try again or contact Customer Support.'
                            )
                        );
                    return $this->postRedirectGet();
                }
            }
        }

        return $this->createPageView()
            ->setVariables(
                compact(
                    'isRecoverPossible',
                    'form'
                )
            )
            ->setTemplate('wellcart-user/recover-account/initiate');
    }

    /**
     * Reset password by token
     */
    public function resetAction()
    {
        $token = $this->params()->fromRoute('token');
        if (!($this->isRecoverPossible) || !($token)
            || !($this->service->isValidToken($token))
        ) {
            $this->flashMessenger()
                ->addWarningMessage(
                    $this->__(
                        'Your password reset link has expired.'
                    )
                );
            return $this->redirect()->toRoute('zfcuser');
        }

        $form = $this->service->getChangePasswordForm();
        $user = $this->service->getRepository()
            ->findOneByPasswordResetToken($token);

        /**
         * @var $request Request
         */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = $request->getPost(null, []);
            $data['identity'] = $user->getEmail();
            $data['credential'] = $user->getPassword();
            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $password = $form->get('newCredential')->getValue();
                    $this->service->resetPassword($user, $password);

                    $this->flashMessenger()
                        ->addSuccessMessage(
                            $this->__(
                                "You update your password. Please, log in."
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
                    return $this->postRedirectGet();
                }
            }
        }

        return $this->createPageView()
            ->setVariables(
                compact(
                    'isRecoverPossible',
                    'form'
                )
            )
            ->setTemplate('wellcart-user/recover-account/reset');
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $auth = $this->zfcUserAuthentication();
        if ($auth->hasIdentity()) {
            $this->flashMessenger()
                ->addWarningMessage(
                    $this->__(
                        'You are already logged in.'
                    )
                );

            return $this->redirect()->toRoute('zfcuser');
        }
    }
}
