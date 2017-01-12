<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Controller\Backend;

use WellCart\Catalog\Form\ProductTemplate as EntityForm;
use WellCart\Catalog\PageView\Backend\ProductTemplateForm as FormPageView;
use WellCart\Catalog\PageView\Backend\ProductTemplatesGrid as GridPageView;
use WellCart\Catalog\Spec\ProductTemplateEntity;
use WellCart\Catalog\Spec\ProductTemplateI18nRepository;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\View\Model\ViewModel;

class ProductTemplatesController extends AbstractActionController implements
    CrudFeature\EntityPersistenceAwareInterface
{

    use CrudFeature\EntityPersistenceAwareTrait,
        CrudFeature\ActionGrantedTrait,
        CrudFeature\HandleEntityFormTrait,
        CrudFeature\FindOrNotFoundTrait;

    /**
     * Constructor
     *
     * @param ProductTemplateI18nRepository $repository
     */
    public function __construct(
        ProductTemplateI18nRepository $repository
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
        $entity = $this->repository->createProductTemplateEntity();

        return $this->handleForm($formPageView, $form, $entity);
    }

    /**
     * Form Handler
     *
     * @param FormPageView          $formPageView
     * @param EntityForm            $form
     * @param ProductTemplateEntity $entity
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        ProductTemplateEntity $entity
    ) {
        return $this->handleEntityForm(
            $formPageView,
            $form,
            $entity,
            __('Product template successfully created.'),
            __('Product template successfully modified.'),
            'zfcadmin/catalog/product-templates'
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
            __('This group no longer exists.'),
            'zfcadmin/catalog/product-templates',
            [],
            [],
            false,
            'findProductTemplateById'
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
            __('This group no longer exists.'),
            'zfcadmin/catalog/product-templates',
            [],
            [],
            false,
            'findProductTemplateById'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('Product template was deleted successfully.'),
                'zfcadmin/catalog/product-templates'
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
            $ids = $this->repository->findAllTemplateIds();
        }

        return $this->attemptToPerformGroupAction(
            $action,
            $ids,
            'zfcadmin/catalog/product-templates'
        );
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'catalog/product-templates/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
