<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\PageView\Backend;

use WellCart\Backend\PageView\Grid\Standard;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Catalog\Exception;
use WellCart\Catalog\Repository\CategoryI18nQuery;
use WellCart\Catalog\Spec\CategoryI18nRepository;
use WellCart\ORM\QueryBuilder;
use WellCart\ORM\Repository;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;

class CategoriesGrid extends Standard
{
    /**
     * Canonical grid name
     */
    const NAME = 'catalog_categories';

    protected $idFieldName = 'category_id';

    /**
     * @var LocaleLanguageEntity
     */
    protected $language;

    public function __construct(
        CategoryI18nRepository $repository,
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
        if (!$repository instanceof CategoryI18nRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\CategoryI18nRepository'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * @param LocaleLanguageEntity $language
     *
     * @return CategoriesGrid
     */
    public function setDisplayLanguage(LocaleLanguageEntity $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param CategoryI18nQuery $qb
     *
     * @return CategoriesGrid
     */
    public function configureQueryBuilder(QueryBuilder $qb)
    {
        parent::configureQueryBuilder($qb);
        $qb->excludeRoot()
            ->sortByCategory()
            ->filterByLanguage($this->language);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function configurePage()
    {
        $this->addLayoutHandle('catalog/categories/grid');
        $this->setPageTitle(__('Categories'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Categories'),
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
        return 'zfcadmin/catalog/categories';
    }

    /**
     * {@inheritDoc}
     */
    public function configureGrid()
    {
        $this->setDefaultOrder($this->idFieldName, 'asc');

        $col = new Datagrid\Column('name');
        $col->setLabel(__('Name'));
        $col->setWidth(75);
        $col->addFormatter(new CategriesGrid\NameFormatter);
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

        $action = new Datagrid\GroupAction();
        $action->setLabel(__('Delete'));
        $action->setLink(
            url_to_route(
                $this->routeName(),
                [
                    'action' => 'group-action-handler',
                    'id'     => 'deleteCategories',
                ]
            )
        );
        //$this->addGroupAction($action);


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
