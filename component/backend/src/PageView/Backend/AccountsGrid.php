<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\PageView\Backend;

use WellCart\Backend\PageView\Grid\Standard;
use WellCart\Backend\Spec\AdministratorRepository;
use WellCart\Directory\Exception;
use WellCart\ORM\Repository;
use WellCart\Ui\Datagrid;

class AccountsGrid extends Standard
{
    /**
     * Canonical grid name
     */
    const NAME = 'admin_accounts';

    public function __construct(
        AdministratorRepository $repository,
        $variables = null,
        $options = null
    ) {
        $this->setRepository($repository);
        parent::__construct($variables, $options);
    }

    /**
     * @inheritdoc
     */
    public function setRepository(Repository $repository)
    {
        if (!$repository instanceof AdministratorRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Backend\Spec\AdministratorRepository'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * {@inheritDoc}
     */
    public function configurePage()
    {
        $this->addLayoutHandle('admin/accounts/grid');
        $this->setPageTitle(__('Administrator Accounts'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Administrators'),
                        'route'  => $this->getRouteName(),
                        'params' => [],
                    ],
                ]
            );
        parent::configurePage();
    }

    /**
     * {@inheritDoc}
     */
    public function getRouteName()
    {
        return 'backend/admin/accounts';
    }

    /**
     * {@inheritDoc}
     */
    public function configureGrid()
    {

        $this->setDefaultOrder($this->idFieldName, 'asc');

        $col = new Datagrid\Column('email');
        $col->setLabel(__('Email'));
        $col->setWidth(30);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $col->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('first_name');
        $col->setLabel(__('First Name'));
        $col->setWidth(20);
        $col->setSortable(true);
        $col->setFilterable(true)
            ->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('last_name');
        $col->setLabel(__('Last Name'));
        $col->setWidth(20);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $col->setFilter('text', 'like');
        $this->addColumn($col);


        $updateAction = new Datagrid\ActionButton();
        $updateAction->setLabel('<i class="fa fa-pencil-square-o"></i>');
        $updateAction->setAttribute('class', 'btn btn-primary btn-xs');
        $updateAction->setAttribute('title', __('Edit'));
        $updateAction->setAttribute('data-toggle', 'tooltip');

        $updateAction->setAttribute(
            'href',
            url_to_route(
                $this->getRouteName(),
                [
                    'action' => 'update',
                    'id'     => $updateAction->getRowIdPlaceholder(),
                ]
            )
        );
        $deleteAction = new Datagrid\ActionButton();
        $deleteAction->setLabel('<i class="fa fa-trash-o"></i>');
        $deleteAction->setAttribute('class', 'btn btn-danger btn-xs');
        $deleteAction->setAttribute('title', __('Delete'));
        $deleteAction->setAttribute('data-toggle', 'tooltip');
        $deleteAction->setAttribute(
            'data-confirm',
            __('Are you sure you want to delete this item?')
        );
        $deleteAction->setAttribute(
            'href',
            url_to_route(
                $this->getRouteName(),
                [
                    'action' => 'delete',
                    'id'     => $deleteAction->getRowIdPlaceholder(),
                ]
            )
        );

        $col = new Datagrid\ActionsColumn();
        $col->setLabel(__('Actions'));
        $col->setWidth(20);
        $col->addAction($updateAction);
        $col->addAction($deleteAction);
        $this->addColumn($col);


        $action = new Datagrid\GroupAction();
        $action->setLabel(__('Delete'));
        $action->setLink(
            url_to_route(
                $this->getRouteName(),
                [
                    'action' => 'group-action-handler',
                    'id'     => 'delete',
                ]
            )
        );
        $this->addGroupAction($action);

        $action = new Datagrid\ToolbarAction();
        $action->setLabel(__('Create'))
            ->setName('create')
            ->setClass(
                'btn btn-toolbar-action btn-circle btn-success pull-right'
            )
            ->setIcon('fa fa-plus')
            ->setLink(
                url_to_route(
                    $this->getRouteName(),
                    [
                        'action' => 'create',
                    ]
                )
            );
        $this->addToolbarAction($action);

        parent::configureGrid();
    }
}
