<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Controller\Backend;

use WellCart\Directory\Form\Zone as EntityForm;
use WellCart\Directory\PageView\Backend\ZoneForm as FormPageView;
use WellCart\Directory\PageView\Backend\ZonesGrid as GridPageView;
use WellCart\Directory\Spec\ZoneEntity;
use WellCart\Directory\Spec\ZoneRepository;
use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\Mvc\Controller\Feature\GroupActionHandlerInterface;
use WellCart\View\Model\JsonModel;
use WellCart\View\Model\ViewModel;

class ZonesController extends AbstractActionController implements
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
     * @param ZoneRepository $repository
     */
    public function __construct(
        ZoneRepository $repository
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
    public function createAction(FormPageView $formPageView, EntityForm $form)
    {
        $entity = $this->repository->createEntity();
        return $this->handleForm($formPageView, $form, $entity);
    }

    /**
     * Form Handler
     *
     * @param FormPageView $formPageView
     * @param EntityForm   $form
     * @param ZoneEntity   $entity
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        ZoneEntity $entity
    ) {
        return $this->handleEntityForm(
            $formPageView,
            $form,
            $entity,
            __('Zone successfully created.'),
            __('Zone successfully modified.'),
            'zfcadmin/directory/zones'
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
            __('This zone no longer exists.'),
            'zfcadmin/directory/zones'
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
            __('This zone no longer exists.'),
            'zfcadmin/directory/zones'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('Zone was deleted successfully.'),
                'zfcadmin/directory/zones'
            );
        }
    }

    /**
     * @return JsonModel
     */
    public function getZoneOptionsAction()
    {
        $country = (int)$this->params()->fromQuery('country_id');
        $zoneOptions = $this->repository->toOptionsList($country, true);
        return new JsonModel($zoneOptions);
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
            'zfcadmin/directory/zones'
        );
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'directory/zones/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
