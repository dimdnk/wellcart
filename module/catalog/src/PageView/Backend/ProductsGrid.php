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
use WellCart\Catalog\Repository\ProductI18nQuery;
use WellCart\Catalog\Spec\ProductI18nRepository;
use WellCart\ORM\QueryBuilder;
use WellCart\ORM\Repository;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;

class ProductsGrid extends Standard
{
    /**
     * Canonical grid name
     */
    const NAME = 'catalog_products';

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
    public function configureQueryBuilder(QueryBuilder $qb)
    {
        parent::configureQueryBuilder($qb);
        $qb->filterByLanguage($this->language)
            ->withVariants();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function configurePage()
    {
        $this->addLayoutHandle('catalog/products/grid');
        $this->setPageTitle(__('Products'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Products'),
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
        return 'zfcadmin/catalog/products';
    }

    /**
     * {@inheritDoc}
     */
    public function configureGrid()
    {
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
