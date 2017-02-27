<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\PageView\Backend;

use Carbon\Carbon;
use WellCart\Backend\PageView\Grid\Standard;
use WellCart\Directory\Exception;
use WellCart\Directory\Spec\CurrencyRepository;
use WellCart\ORM\Repository;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;

class CurrenciesGrid extends Standard
{

    /**
     * Canonical grid name
     */
    const NAME = 'directory_currencies';

    protected $timeZone;

    public function __construct(
        CurrencyRepository $repository,
        $timeZone,
        $variables = null,
        $options = null
    ) {
        $this->setRepository($repository);
        parent::__construct($variables, $options);
        $this->timeZone = $timeZone;
    }

    /**
     * @inheritdoc
     */
    public function setRepository(Repository $repository)
    {
        if (!$repository instanceof CurrencyRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Directory\Spec\CurrencyRepository'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * {@inheritDoc}
     */
    public function configurePage()
    {
        $this->addLayoutHandle('directory/currencies/grid');
        $this->setPageTitle(__('Currency List'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Currencies'),
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
        return 'zfcadmin/directory/currencies';
    }

    /**
     * {@inheritDoc}
     */
    public function configureGrid()
    {
        $this->setDefaultOrder($this->idFieldName, 'asc');

        $col = new Datagrid\Column('title');
        $col->setLabel(__('Currency Title'));
        $col->setWidth(20);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('code');
        $col->setLabel(__('Code'));
        $col->setWidth(10);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('exchange_rate');
        $col->setLabel(__('Exchange Rate'));
        $col->setWidth(15);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);


        $col = new Datagrid\Column('is_primary');
        $col->setLabel(__('Primary'));
        $col->setWidth(10);
        $col->setType(new ColumnType\YesNo());
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('yesNoSelector', 'eq');
        $this->addColumn($col);


        $col = new Datagrid\Column('updated_at');
        $col->setLabel(__('Updated At'));
        $col->setWidth(20);
        $type = new ColumnType\DateTime(
            Carbon::DEFAULT_TO_STRING_FORMAT,
            \IntlDateFormatter::MEDIUM,
            \IntlDateFormatter::SHORT
        );
        $type->setOutputTimezone(
            $this->timeZone
        );
        $col->setType($type);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('daterange', 'between');
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

        $delete = new Datagrid\GroupAction();
        $delete->setTitle('Delete');
        $delete->setLink(
            url_to_route(
                $this->getRouteName(),
                [
                    'action' => 'group-action-handler',
                    'id'     => 'delete',
                ]
            )
        );
        $this->addGroupAction($delete);

        $updateRates = new Datagrid\GroupAction();
        $updateRates->setTitle('Update currency rates');
        $updateRates->setLink(
            url_to_route(
                $this->getRouteName(),
                [
                    'action' => 'group-action-handler',
                    'id'     => 'update_rates',
                ]
            )
        );
        $this->addGroupAction($updateRates);


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
