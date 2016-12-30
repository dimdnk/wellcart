<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Controller;

use WellCart\Mvc\Controller\AbstractActionController;

class LogoutController extends AbstractActionController
{

    /**
     * Logout page
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function logoutAction()
    {
        $this->zfcUserAuthentication()->getAuthAdapter()->resetAdapters();
        $this->zfcUserAuthentication()->getAuthAdapter()->logoutAdapters();
        $this->zfcUserAuthentication()->getAuthService()->clearIdentity();
        return $this->redirect()->toRoute('zfcadmin');
    }
}
