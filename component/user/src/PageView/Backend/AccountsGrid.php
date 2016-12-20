<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\PageView\Backend;

use WellCart\Admin\PageView\Grid\Standard;
use WellCart\Directory\Exception;
use WellCart\ORM\Repository;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;
use WellCart\User\Spec\UserRepository;

class AccountsGrid extends Standard
{
    public function __construct(
        UserRepository $repository,
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
        if (!$repository instanceof UserRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\User\Spec\UserRepository'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * {@inheritDoc}
     */
    protected function scope()
    {
        return 'user_accounts';
    }

    /**
     * {@inheritDoc}
     */
    protected function configurePage()
    {
        $this->addLayoutHandle('user/accounts/grid');
        $this->setPageTitle(__('User Accounts'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Users'),
                        'route'  => $this->routeName(),
                        'params' => [],
                    ],
                ]
            );

    }

    /**
     * {@inheritDoc}
     */
    protected function routeName()
    {
        return 'zfcadmin/user/accounts';
    }

    /**
     * {@inheritDoc}
     */
    protected function configureGrid()
    {
        $this->setId('wellcart_user_admin_accounts_grid');

        $this->setDefaultOrder($this->idFieldName, 'asc');

        $col = new Datagrid\Column('email');
        $col->setLabel(__('Email'));
        $col->setWidth(30);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('first_name');
        $col->setLabel(__('First Name'));
        $col->setWidth(20);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('last_name');
        $col->setLabel(__('Last Name'));
        $col->setWidth(20);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);


        $updateButton = new Datagrid\RowButton();
        $updateButton->setLabel('<i class="fa fa-pencil-square-o"></i>');
        $updateButton->setAttribute('class', 'btn btn-primary btn-xs');
        $updateButton->setAttribute('title', __('Edit'));
        $updateButton->setAttribute('data-toggle', 'tooltip');
        $updateButton->setAttribute(
            'href',
            url_to_route(
                $this->routeName(),
                [
                    'action' => 'update',
                    'id'     => $updateButton->getRowIdPlaceholder()
                ]
            )
        );
        $deleteButton = new Datagrid\RowButton();
        $deleteButton->setLabel('<i class="fa fa-trash-o"></i>');
        $deleteButton->setAttribute('class', 'btn btn-danger btn-xs');
        $deleteButton->setAttribute('title', __('Delete'));
        $deleteButton->setAttribute('data-toggle', 'tooltip');
        $deleteButton->setAttribute(
            'data-confirm',
            __('Are you sure you want to delete this item?')
        );
        $deleteButton->setAttribute(
            'href',
            url_to_route(
                $this->routeName(),
                [
                    'action' => 'delete',
                    'id'     => $deleteButton->getRowIdPlaceholder()
                ]
            )
        );

        $col = new Datagrid\ActionsColumn();
        $col->setLabel(__('Actions'));
        $col->setWidth(20);
        $col->addAction($updateButton);
        $col->addAction($deleteButton);
        $this->addColumn($col);

        $action = new Datagrid\GroupAction();
        $action->setLabel(__('Delete'));
        $action->setLink(
            url_to_route(
                $this->routeName(),
                [
                    'action' => 'group-action-handler',
                    'id'     => 'delete',
                ]
            )
        );
        $this->addGroupAction($action);


        $action = new Datagrid\ToolbarButton();
        $action->setLabel(__('Create'))
            ->setName('create')
            ->setClass(
                'btn btn-toolbar-action btn-circle btn-success pull-right'
            )
            ->setIcon('fa fa-plus')
            ->setLink(
                url_to_route(
                    $this->routeName(),
                    [
                        'action' => 'create',
                    ]
                )
            );
        $this->addToolbarButton($action);
    }
}
