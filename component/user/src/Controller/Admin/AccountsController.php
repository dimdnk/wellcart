<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Controller\Admin;

use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\Mvc\Controller\Feature\GroupActionHandlerInterface;
use WellCart\User\Command;
use WellCart\User\Form\Account as EntityForm;
use WellCart\User\PageView\Admin\AccountForm as FormPageView;
use WellCart\User\PageView\Admin\AccountsGrid as GridPageView;
use WellCart\User\Spec\UserEntity;
use WellCart\User\Spec\UserRepository;
use WellCart\Utility\Arr;
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
     * @param UserRepository $repository
     */
    public function __construct(
        UserRepository $repository
    ) {
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
     * @return mixed|\WellCart\Ui\Container\PreparableContainerInterface
     */
    public function createAction(FormPageView $formPageView, EntityForm $form)
    {
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
     * @param FormPageView $formPageView
     * @param EntityForm   $form
     * @param UserEntity   $entity
     *
     * @return mixed|\WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        UserEntity $entity
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
            $files = $request->getFiles($form->getName(), []);
            $postData = Arr::merge(
                $postData, $files, true
            );
            $form->setPostData($postData);

            if ($form->isValid()) {
                $entity = $form->getData();
                $entity->setId($id);

                $command = new Command\PersistUserAccount($entity, $postData);
                return $this->attemptToPersistEntity(
                    $command,
                    __('User profile successfully created.'),
                    __('User profile successfully modified.'),
                    'zfcadmin/user/accounts'
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
     * @return ViewModel|\Zend\Http\Response
     */
    public function updateAction(FormPageView $formPageView, EntityForm $form)
    {
        $domainResponse = $this->findOrNotFound(
            __('This user account no longer exists.'),
            'zfcadmin/user/accounts'
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
            __('This user account no longer exists.'),
            'zfcadmin/user/accounts'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('User was deleted successfully.'),
                'zfcadmin/user/accounts'
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
        $selectionType = (string)$params->fromPost('selection_type', 'selected');
        $ids = (array)$params->fromPost('ids', []);
        if ($selectionType == 'all') {
            $ids = $this->repository->findAllIds();
        }
        return $this->attemptToPerformGroupAction(
            $action,
            $ids,
            'zfcadmin/user/accounts'
        );
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'user/accounts/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
