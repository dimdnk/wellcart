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
use WellCart\RestApi\Repository\OAuth2\PublicKeys as PublicKeyRepository;
use WellCart\Ui\Datagrid;

class PublicKeysGrid extends Standard
{
    /**
     * Canonical grid name
     */
    const NAME = 'api_public_keys';

    public function __construct(
        PublicKeyRepository $repository,
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
        if (!$repository instanceof PublicKeyRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must instance of WellCart\RestApi\Repository\OAuth2\PublicKey'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * {@inheritDoc}
     */
    public function configurePage()
    {
        $this->addLayoutHandle('api/oauth2-public-keys/grid');
        $this->setPageTitle(__('OAuth2 Public Keys'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Public Keys'),
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
        return 'zfcadmin/api/oauth2-public-keys';
    }

    /**
     * {@inheritDoc}
     */
    public function configureGrid()
    {
        $this->setDefaultOrder($this->idFieldName, 'asc');

        $col = new Datagrid\Column('public_key');
        $col->setLabel(__('Public Key'));
        $col->setWidth(30);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('private_key');
        $col->setLabel(__('Private Key'));
        $col->setWidth(30);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('encryption_algorithm');
        $col->setLabel(__('Encryption'));
        $col->setWidth(10);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);


        $updateAction = new Datagrid\ActionButton();
        $updateAction->setLabel('<i class="fa fa-pencil-square-o"></i>');
        $updateAction->setAttribute('class', 'btn btn-primary btn-xs');
        $updateAction->setAttribute('title', __('Edit'));
        $updateAction->setAttribute('data-toggle', 'tooltip');
        $updateAction->setAttribute(
            'href',
            url_to_route(
                $this->routeName(),
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
                $this->routeName(),
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
