<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Controller\Admin\OAuth2;

use WellCart\Mvc\Controller\AbstractActionController;
use WellCart\Mvc\Controller\Feature\Crud as CrudFeature;
use WellCart\RestApi\Entity\OAuth2\Client as ClientEntity;
use WellCart\RestApi\Form\OAuth2\Client as EntityForm;
use WellCart\RestApi\PageView\Admin\OAuth2\ClientForm as FormPageView;
use WellCart\RestApi\PageView\Admin\OAuth2\ClientsGrid as GridPageView;
use WellCart\RestApi\Repository\OAuth2\Clients as ClientRepository;
use WellCart\View\Model\ViewModel;

class ClientsController extends AbstractActionController implements
    CrudFeature\EntityPersistenceAwareInterface
{
    use CrudFeature\EntityPersistenceAwareTrait,
        CrudFeature\HandleEntityFormTrait,
        CrudFeature\FindOrNotFoundTrait,
        CrudFeature\ActionGrantedTrait;

    /**
     * Constructor
     *
     * @param ClientRepository $repository
     */
    public function __construct(
        ClientRepository $repository
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
     * @param ClientEntity $entity
     *
     * @return \WellCart\Ui\Container\PreparableContainerInterface
     */
    public function handleForm(
        FormPageView $formPageView,
        EntityForm $form,
        ClientEntity $entity
    ) {
        return $this->handleEntityForm(
            $formPageView,
            $form,
            $entity,
            __('Client successfully created.'),
            __('Client successfully modified.'),
            'zfcadmin/api/oauth2-clients'
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
            __('This client no longer exists.'),
            'zfcadmin/api/oauth2-clients'
        );

        if ($domainResponse) {
            $form->removePasswordElements();
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
            __('This client no longer exists.'),
            'zfcadmin/api/oauth2-clients'
        );
        if ($domainResponse) {
            return $this->attemptToDeleteEntity(
                $domainResponse,
                __('Client was deleted successfully.'),
                'zfcadmin/api/oauth2-clients'
            );
        }
    }

    /**
     * @inheritdoc
     */
    protected function preDispatch($mvcEvent)
    {
        $action = $this->params('action', 'not-found');
        $permission = 'api/oauth2-clients/' . $action;
        $this->isGrantedOrDeny($permission);
    }
}
