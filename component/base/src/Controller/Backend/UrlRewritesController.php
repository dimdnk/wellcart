<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Controller\Backend;

use WellCart\Base\Form\UrlRewrite as EntityForm;
use WellCart\Base\PageView\Backend\UrlRewriteForm as FormPageView;
use WellCart\Base\PageView\Backend\UrlRewritesGrid as GridPageView;
use WellCart\Base\Spec\UrlRewriteEntity;
use WellCart\Base\Spec\UrlRewriteRepository;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\Mvc\Controller\Feature\GroupActionHandlerInterface;
use WellCart\View\Model\ViewModel;

class UrlRewritesController extends AbstractActionController implements
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
     * @param UrlRewriteRepository $repository
     */
    public function __construct(
        UrlRewriteRepository $repository
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
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function createAction(
        FormPageView $formPageView,
        EntityForm $form
    ) {
        $entity = $this->repository->createEntity();

        return $this->handleForm($formPageView, $form, $entity);
    }

    /**
     * Form Handler
     *
     * @param FormPageView     $formPageView
     * @param EntityForm       $form
     * @param UrlRewriteEntity $entity
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        UrlRewriteEntity $entity
    ) {
        return $this->handleEntityForm(
            $formPageView,
            $form,
            $entity,
            __('Url Rewrite successfully created.'),
            __('Url Rewrite successfully modified.'),
            'zfcadmin/base/url-rewrites'
        );
    }

    /**
     * Update Entity
     *
     * @param FormPageView $formPageView
     * @param EntityForm   $form
     *
     * @return ViewModel|\Zend\Http\Response
     */
    public function updateAction(
        FormPageView $formPageView,
        EntityForm $form
    ) {
        $domainResponse = $this->findOrNotFound(
            __('This url rewrite no longer exists.'),
            'zfcadmin/base/url-rewrites'
        );

        if ($domainResponse) {
            return $this->handleForm(
                $formPageView,
                $form,
                $domainResponse
            );
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
            __('This url rewrite no longer exists.'),
            'zfcadmin/base/url-rewrites'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('URL rewrite was deleted successfully.'),
                'zfcadmin/base/url-rewrites'
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
            'zfcadmin/base/url-rewrites'
        );
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'base/url-rewrites/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
