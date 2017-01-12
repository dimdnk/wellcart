<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Controller\Backend;

use WellCart\Backend\PageView\Backend\NotificationsGrid as GridPageView;
use WellCart\Backend\Spec\NotificationRepository;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\Mvc\Controller\Feature\GroupActionHandlerInterface;
use WellCart\View\Model\ViewModel;

class NotificationsController extends AbstractActionController implements
    GroupActionHandlerInterface,
    CrudFeature\EntityPersistenceAwareInterface
{

    use CrudFeature\EntityPersistenceAwareTrait,
        CrudFeature\ActionGrantedTrait,
        CrudFeature\FindOrNotFoundTrait;

    /**
     * Constructor
     *
     * @param NotificationRepository $repository
     */
    public function __construct(NotificationRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * @param GridPageView $gridPageView
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function listAction(GridPageView $gridPageView)
    {
        return $gridPageView->prepare();
    }

    /**
     * Delete entity
     *
     * @return ViewModel
     */
    public function deleteAction()
    {
        $domainResponse = $this->findOrNotFound(
            __('This message no longer exists.'),
            'zfcadmin/admin/notifications'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('Notification was deleted successfully.'),
                'zfcadmin/admin/notifications'
            );
        }
    }

    /**
     * Delete entity
     *
     * @return ViewModel
     */
    public function markAsReadAction()
    {
        $domainResponse = $this->findOrNotFound(
            __('This message no longer exists.'),
            'zfcadmin/admin/notifications'
        );
        if ($domainResponse) {
            $domainResponse->setIsRead(true);

            return $this->attemptToPersistEntity(
                $domainResponse,
                __('The message has been marked as Read.'),
                __('The message has been marked as Read.')
            );
        }
    }

    /**
     * Group action handler
     *
     * @return \Zend\Http\Response
     */
    public function groupActionHandlerAction()
    {
        $params = $this->params();
        $action = $params->fromRoute('id');
        $selectionType = (string)$params->fromPost(
            'selection_type', 'selected'
        );
        $ids = (array)$params->fromPost('ids', []);
        if ($selectionType == 'all') {
            $ids = $this->repository->findAllIds();
        }

        return $this->attemptToPerformGroupAction(
            $action,
            $ids,
            'zfcadmin/admin/notifications'
        );
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'admin/notifications/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
