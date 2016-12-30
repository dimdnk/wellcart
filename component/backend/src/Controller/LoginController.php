<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Controller;

use Zend\Authentication\Result as AuthenticationResult;
use ZfcUser\Controller\UserController;

class LoginController extends UserController
{

    /**
     * Login page
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function loginAction()
    {
        /**
         * @var $auth  \ZfcUser\Controller\Plugin\ZfcUserAuthentication
         */
        $auth = $this->zfcUserAuthentication();

        $request = $this->getRequest();
        $form = $this->getLoginForm();
        if ($auth->hasIdentity() || !$request->isPost()) {
            return $this->createPageView()
                ->setVariable('form', $form)
                ->setTemplate('wellcart-backend/login/form');
        }

        $form->setData($request->getPost(null, []));

        if (!$form->isValid()) {
            return $this->createPageView()
                ->setVariable('form', $form)
                ->setTemplate('wellcart-backend/login/form');
        }

        $adapter = $auth->getAuthAdapter();
        // clear adapters
        $adapter->resetAdapters();
        $auth->getAuthService()->clearIdentity();

        try {
            $adapter->prepareForAuthentication($this->getRequest());
            $auth = $auth->getAuthService()->authenticate($adapter);

            if (!$auth->isValid()) {
                $adapter->resetAdapters();
                if (
                in_array(
                    $auth->getCode(),
                    [
                        AuthenticationResult::FAILURE_CREDENTIAL_INVALID,
                        AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND,
                        AuthenticationResult::FAILURE_UNCATEGORIZED]
                )
                ) {
                    $message = __(
                        'Unable to log in. Please check that you have entered your login and password correctly.'
                    );
                } else {
                    $message = $auth->getMessages()[0];
                }

                $this->flashMessenger()->addErrorMessage(
                    $message
                );
                return $this->redirect()->toRoute('zfcadmin');
            }
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $this->flashMessenger()->addErrorMessage($e->getMessage());
            return $this->redirect()->toRoute('zfcadmin');
        }


        return $this->redirect()->refresh();
    }
}
