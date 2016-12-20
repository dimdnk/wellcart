<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Controller\Backend;

use WellCart\CMS\Form\Page as EntityForm;
use WellCart\CMS\PageView\Backend\PageForm as FormPageView;
use WellCart\CMS\PageView\Backend\PagesGrid as GridPageView;
use WellCart\CMS\Spec\PageEntity;
use WellCart\CMS\Spec\PageI18nRepository;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\Mvc\Controller\Feature\GroupActionHandlerInterface;
use WellCart\View\Model\ViewModel;

class PagesController extends AbstractActionController implements
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
     * @param PageI18nRepository $repository
     */
    public function __construct(
        PageI18nRepository $repository
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

        $gridPageView->setDisplayLanguage(
            $this->locale()->getLanguage()
        );
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
    public function createAction(FormPageView $formPageView, EntityForm $form)
    {
        $entity = $this->repository->createPageEntity();
        return $this->handleForm($formPageView, $form, $entity);
    }

    /**
     * Form Handler
     *
     * @param FormPageView $formPageView
     * @param EntityForm   $form
     * @param PageEntity   $entity
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        PageEntity $entity
    ) {
        return $this->handleEntityForm(
            $formPageView,
            $form,
            $entity,
            __('Page successfully created.'),
            __('Page successfully modified.'),
            'zfcadmin/cms/pages'
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
    public function updateAction(FormPageView $formPageView, EntityForm $form)
    {
        $domainResponse = $this->findOrNotFound(
            __('This page no longer exists.'),
            'zfcadmin/cms/pages',
            [],
            [],
            false,
            'findPageById'
        );

        if ($domainResponse) {
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
            __('This page no longer exists.'),
            'zfcadmin/cms/pages',
            [],
            [],
            false,
            'findPageById'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('Page was deleted successfully.'),
                'zfcadmin/cms/pages'
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
            $ids = $this->repository->findAllPageIds();
        }
        return $this->attemptToPerformGroupAction(
            $action,
            $ids,
            'zfcadmin/cms/pages'
        );
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'cms/pages/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
