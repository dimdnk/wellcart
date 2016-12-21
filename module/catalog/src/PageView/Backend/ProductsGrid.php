<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\PageView\Backend;

use WellCart\Admin\PageView\Grid\Standard;
use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\Catalog\Exception;
use WellCart\Catalog\Repository\ProductI18nQuery;
use WellCart\Catalog\Spec\ProductI18nRepository;
use WellCart\ORM\QueryBuilder;
use WellCart\ORM\Repository;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;

class ProductsGrid extends Standard
{

    protected $idFieldName = 'product_id';

    /**
     * @var LocaleLanguageEntity
     */
    protected $language;

    public function __construct(
        ProductI18nRepository $repository,
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
        if (!$repository instanceof ProductI18nRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\ProductI18nRepository'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * @param LocaleLanguageEntity $language
     *
     * @return ProductsGrid
     */
    public function setDisplayLanguage(LocaleLanguageEntity $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @param ProductI18nQuery $qb
     *
     * @return ProductsGrid
     */
    protected function configureQueryBuilder(QueryBuilder $qb)
    {
        parent::configureQueryBuilder($qb);
        $qb->filterByLanguage($this->language)
            ->withVariants();
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function scope()
    {
        return 'catalog_products';
    }

    /**
     * {@inheritDoc}
     */
    protected function configurePage()
    {
        $this->addLayoutHandle('catalog/products/grid');
        $this->setPageTitle(__('Products'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Products'),
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
        return 'zfcadmin/catalog/products';
    }

    /**
     * {@inheritDoc}
     */
    protected function configureGrid()
    {
        $this->setId('wellcart_catalog_admin_products_grid');

        $this->setDefaultOrder($this->idFieldName, 'asc');

        $col = new Datagrid\Column('name');
        $col->setLabel(__('Name'));
        $col->setWidth(50);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('variants.price');
        $col->setLabel(__('Price'));
        $col->setWidth(10);
        $col->setSortable(true);
        $col->setFilterable(true)->setFilter('rangeFilter', 'range');
        $col->addFormatter(new ProductsGrid\PriceFormatter);
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