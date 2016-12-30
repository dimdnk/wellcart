<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Controller;

use WellCart\Backend\Service\RecoverAccount as RecoverAccountService;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Utility\Config;
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
        $this->isRecoverPossible = ($this->service->isRecoverPossible()
            && Config::get(
                'wellcart.user_account_options.password_reset.allow_for_admin',
                true
            ));
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
                        'admin-account-recovery/reset'
                    );
                    $this->flashMessenger()
                        ->addSuccessMessage(
                            $this->__(
                                "We'll email you a link to reset your password."
                            )
                        );
                    return $this->redirect()->toRoute('zfcadmin');
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

        return
            $this->createPageView()
                ->setVariables(
                    compact(
                        'isRecoverPossible',
                        'form'
                    )
                )
                ->setTemplate('wellcart-backend/recover-account/initiate');
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
            return $this->redirect()->toRoute('zfcadmin');
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
                    return $this->redirect()->toRoute('zfcadmin');
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

        return
            $this->createPageView()
                ->setVariables(
                    compact(
                        'isRecoverPossible',
                        'form'
                    )
                )
                ->setTemplate('wellcart-backend/recover-account/reset');
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $this->layoutManager()->setArea('backend/unauthorized');
        $auth = $this->zfcUserAuthentication();
        if ($auth->hasIdentity()) {
            $this->flashMessenger()
                ->addWarningMessage(
                    $this->__(
                        'You are already logged in.'
                    )
                );

            return $this->redirect()->toRoute('zfcadmin');
        }
    }
}
