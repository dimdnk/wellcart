<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\PageView\Backend;

use WellCart\Backend\PageView\Grid\Standard;
use WellCart\Directory\Exception;
use WellCart\ORM\Repository;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;
use WellCart\User\Spec\AclRoleRepository;

class RolesGrid extends Standard
{
    /**
     * Canonical grid name
     */
    const NAME = 'user_acl_roles';

    public function __construct(
        AclRoleRepository $repository,
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
        if (!$repository instanceof AclRoleRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\User\Spec\AclRoleRepository'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * {@inheritDoc}
     */
    public function configurePage()
    {
        $this->addLayoutHandle('user/roles/grid');
        $this->setPageTitle(__('User Roles'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('User Roles'),
                        'route'  => $this->routeName(),
                        'params' => [],
                    ],
                ]
            );
        parent::configurePage();
    }

    /**
     * {@inheritDoc}
     */
    protected function routeName()
    {
        return 'zfcadmin/user/roles';
    }

    /**
     * {@inheritDoc}
     */
    public function configureGrid()
    {
        $this->setDefaultOrder($this->idFieldName, 'asc');

        $col = new Datagrid\Column('name');
        $col->setLabel(__('Role Name'));
        $col->setWidth(70);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('is_default');
        $col->setLabel(__('Is Default'));
        $col->setWidth(10);
        $col->setType(new ColumnType\YesNo());
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('yesNoSelector', 'eq');
        $this->addColumn($col);

        $updateButton = new Datagrid\ActionButton();
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
                    'id'     => $updateButton->getRowIdPlaceholder(),
                ]
            )
        );
        $deleteButton = new Datagrid\ActionButton();
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
                    'id'     => $deleteButton->getRowIdPlaceholder(),
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
        //$this->addGroupAction($action);


        $action = new Datagrid\ToolbarAction();
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
        $this->addToolbarAction($action);
        parent::configureGrid();
    }
}
