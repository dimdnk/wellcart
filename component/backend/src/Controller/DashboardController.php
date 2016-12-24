<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Controller;

use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud\ActionGrantedTrait;

class DashboardController extends AbstractActionController
{
    use ActionGrantedTrait;

    /**
     * Dashboard page
     *
     * @return array|\Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        return $this->createPageView()
            ->setTemplate('wellcart-backend/dashboard/index');
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $permission = 'admin/dashboard/view';
        $this->isGrantedOrDeny($permission);
    }
}
