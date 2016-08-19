<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Controller;

use ZfcUser\Controller\UserController as AbstractActionController;

class UserController extends AbstractActionController
{

    public function authenticateAction()
    {
        try {
            return parent::authenticateAction();
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $this->flashMessenger()->addErrorMessage($e->getMessage());
            return $this->redirect()->toRoute('zfcuser');
        }
    }
}
