<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

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

        $delete = new Datagrid\GroupAction();
        $delete->setTitle('Delete');
        $delete->setLink(
            url_to_route(
                $this->routeName(),
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
                $this->routeName(),
                [
                    'action' => 'group-action-handler',
                    'id'     => 'update_rates',
                ]
            )
        );
        $this->addGroupAction($updateRates);


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
        parent::configureGrid();
    }
}
