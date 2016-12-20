<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Controller\Backend;

use WellCart\Catalog\Form\Attribute as EntityForm;
use WellCart\Catalog\PageView\Backend\AttributeForm as FormPageView;
use WellCart\Catalog\PageView\Backend\AttributesGrid as GridPageView;
use WellCart\Catalog\Spec\AttributeEntity;
use WellCart\Catalog\Spec\AttributeI18nRepository;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\View\Model\ViewModel;

class AttributesController extends AbstractActionController implements
    CrudFeature\EntityPersistenceAwareInterface
{

    use CrudFeature\EntityPersistenceAwareTrait,
        CrudFeature\ActionGrantedTrait,
        CrudFeature\HandleEntityFormTrait,
        CrudFeature\FindOrNotFoundTrait;

    /**
     * Constructor
     *
     * @param AttributeI18nRepository $repository
     */
    public function __construct(
        AttributeI18nRepository $repository
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
     * @return ViewModel|\Zend\Http\Response
     */
    public function createAction(FormPageView $formPageView, EntityForm $form)
    {
        $entity = $this->repository->createAttributeEntity();
        return $this->handleForm($formPageView, $form, $entity);
    }

    /**
     * Form Handler
     *
     * @param FormPageView    $formPageView
     * @param EntityForm      $form
     * @param AttributeEntity $entity
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        AttributeEntity $entity
    ) {
        return $this->handleEntityForm(
            $formPageView,
            $form,
            $entity,
            __('Attribute successfully created.'),
            __('Attribute successfully modified.'),
            'zfcadmin/catalog/attributes'
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
            __('This attribute no longer exists.'),
            'zfcadmin/catalog/attributes',
            [],
            [],
            false,
            'findAttributeById'
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
            __('This attribute no longer exists.'),
            'zfcadmin/catalog/attributes',
            [],
            [],
            false,
            'findAttributeById'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('Attribute was deleted successfully.'),
                'zfcadmin/catalog/attributes'
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
            $ids = $this->repository->findAllAttributeIds();
        }
        return $this->attemptToPerformGroupAction(
            $action,
            $ids,
            'zfcadmin/catalog/attributes'
        );
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'catalog/attributes/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
