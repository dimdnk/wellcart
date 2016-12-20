<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Controller\Backend\OAuth2;

use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\RestApi\Entity\OAuth2\Scope as ScopeEntity;
use WellCart\RestApi\Form\OAuth2\Scope as EntityForm;
use WellCart\RestApi\PageView\Backend\OAuth2\ScopeForm as FormPageView;
use WellCart\RestApi\PageView\Backend\OAuth2\ScopesGrid as GridPageView;
use WellCart\RestApi\Repository\OAuth2\Scopes as ScopeRepository;
use WellCart\View\Model\ViewModel;

class ScopesController extends AbstractActionController implements
    CrudFeature\EntityPersistenceAwareInterface
{
    use CrudFeature\EntityPersistenceAwareTrait,
        CrudFeature\HandleEntityFormTrait,
        CrudFeature\FindOrNotFoundTrait,
        CrudFeature\ActionGrantedTrait;

    /**
     * Constructor
     *
     * @param ScopeRepository $repository
     */
    public function __construct(
        ScopeRepository $repository
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
        return $this->handleForm($formPageView, $form, $entity);
    }

    /**
     * Form Handler
     *
     * @param FormPageView $formPageView
     * @param EntityForm   $form
     * @param ScopeEntity  $entity
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        ScopeEntity $entity
    ) {
        return $this->handleEntityForm(
            $formPageView,
            $form,
            $entity,
            __('Scope successfully created.'),
            __('Scope successfully modified.'),
            'zfcadmin/api/oauth2-scopes'
        );
    }

    /**
     * Update Entity
     *
     * @param FormPageView $formPageView
     * @param EntityForm   $form
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function updateAction(
        FormPageView $formPageView,
        EntityForm $form
    ) {
        $domainResponse = $this->findOrNotFound(
            __('This scope no longer exists.'),
            'zfcadmin/api/oauth2-scopes'
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
     * @return mixed
     */
    public function deleteAction()
    {
        $domainResponse = $this->findOrNotFound(
            __('This scope no longer exists.'),
            'zfcadmin/api/oauth2-scopes'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('Scope was deleted successfully.'),
                'zfcadmin/api/oauth2-scopes'
            );
        }
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'api/oauth2-scopes/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
