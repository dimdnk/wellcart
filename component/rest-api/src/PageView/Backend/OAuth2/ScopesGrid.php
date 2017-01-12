<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\PageView\Backend\OAuth2;

use WellCart\Backend\PageView\Grid\Standard;
use WellCart\ORM\Repository;
use WellCart\RestApi\Exception;
use WellCart\RestApi\Repository\OAuth2\Scopes as ScopeRepository;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;

class ScopesGrid extends Standard
{

    public function __construct(
        ScopeRepository $repository,
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
        if (!$repository instanceof ScopeRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must instance of WellCart\RestApi\Repository\OAuth2\Scope'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * {@inheritDoc}
     */
    protected function scope()
    {
        return 'api_scopes';
    }

    /**
     * {@inheritDoc}
     */
    protected function configurePage()
    {
        $this->addLayoutHandle('api/oauth2-scopes/grid');
        $this->setPageTitle(__('OAuth2 Scopes'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Scopes'),
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
        return 'zfcadmin/api/oauth2-scopes';
    }

    /**
     * {@inheritDoc}
     */
    protected function configureGrid()
    {
        $this->setId('wellcart_api_scopes');

        $this->setDefaultOrder($this->idFieldName, 'asc');

        $col = new Datagrid\Column('scope');
        $col->setLabel(__('Scope'));
        $col->setWidth(70);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('is_default');
        $col->setLabel(__('Primary'));
        $col->setWidth(10);
        $col->setType(new ColumnType\YesNo());
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('yesNoSelector', 'eq');
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
                    'id'     => $updateButton->getRowIdPlaceholder(),
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
