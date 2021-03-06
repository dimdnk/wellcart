<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Controller\Backend;

use WellCart\Backend\Command;
use WellCart\Backend\Form\Account as EntityForm;
use WellCart\Backend\PageView\Backend\AccountForm as FormPageView;
use WellCart\Backend\PageView\Backend\AccountsGrid as GridPageView;
use WellCart\Backend\Spec\AdministratorEntity;
use WellCart\Backend\Spec\AdministratorRepository;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\Mvc\Controller\Feature\GroupActionHandlerInterface;
use WellCart\View\Model\ViewModel;
use Zend\Http\PhpEnvironment\Request;

class AccountsController extends AbstractActionController implements
    GroupActionHandlerInterface,
    CrudFeature\EntityPersistenceAwareInterface
{

    use CrudFeature\EntityPersistenceAwareTrait,
        CrudFeature\ActionGrantedTrait,
        CrudFeature\HandleEntityFormTrait,
        CrudFeature\FindOrNotFoundTrait;

    /**
     * Constructor
     *
     * @param AdministratorRepository $repository
     */
    public function __construct(AdministratorRepository $repository)
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
     * Create new entity
     *
     * @param FormPageView $formPageView
     * @param EntityForm   $form
     *
     * @return ViewModel|\Zend\Http\Response
     */
    public function createAction(
        FormPageView $formPageView,
        EntityForm $form
    ) {
        $entity = $this->repository->createEntity();
        /**
         * @var $form EntityForm
         */
        $form->makePasswordRequired()
            ->bind($entity);

        return $this->handleForm($formPageView, $form, $entity);
    }

    /**
     * Form Handler
     *
     * @param FormPageView        $formPageView
     * @param EntityForm          $form
     * @param AdministratorEntity $entity
     *
     * @return mixed|\WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        AdministratorEntity $entity
    ) {
        $formPageView
            ->setEntity($entity)
            ->setForm($form);

        $id = null;
        if ($entity->getId() > 0) {
            $id = $entity->getId();
        }

        /**
         * @var $request Request
         */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData = $request->getPost($form->getName(), []);
            $form->setPostData($postData);

            if ($form->isValid()) {
                $entity = $form->getData();
                $entity->setId($id);
                $command = new Command\PersistAdminAccount($entity, $postData);

                return $this->attemptToPersistEntity(
                    $command,
                    __('Admin profile successfully created.'),
                    __('Admin profile successfully modified.'),
                    'backend/admin/accounts'
                );
            }
        }

        return $formPageView->prepare();
    }

    /**
     * Update Entity
     *
     * @param FormPageView $formPageView
     * @param EntityForm   $form
     *
     * @return mixed|\WellCart\Ui\Container\PreparableContainerInterface
     */
    public function updateAction(
        FormPageView $formPageView,
        EntityForm $form
    ) {
        $domainResponse = $this->findOrNotFound(
            __('This admin account no longer exists.'),
            'backend/admin/accounts'
        );

        if ($domainResponse) {
            $form->makePasswordOptional()
                ->bind($domainResponse);

            return $this->handleForm($formPageView, $form, $domainResponse);
        }
    }

    /**
     * Delete entity
     *
     * @return ViewModel
     */
    public function deleteAction()
    {
        $domainResponse = $this->findOrNotFound(
            __('This admin account no longer exists.'),
            'backend/admin/accounts'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('Admin was deleted successfully.'),
                'backend/admin/accounts'
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
            'backend/admin/accounts'
        );
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'admin/accounts/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
