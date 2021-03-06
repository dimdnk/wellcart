<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\PageView\Backend;

use Carbon\Carbon;
use WellCart\Backend\PageView\Grid\Standard;
use WellCart\Backend\Spec\NotificationRepository;
use WellCart\Directory\Exception;
use WellCart\ORM\QueryBuilder;
use WellCart\ORM\Repository;
use WellCart\Ui\Datagrid;
use WellCart\Ui\Datagrid\Column\Type as ColumnType;

class NotificationsGrid extends Standard
{
    /**
     * Canonical grid name
     */
    const NAME = 'admin_notifications';

    public function __construct(
        NotificationRepository $repository,
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
        if (!$repository instanceof NotificationRepository) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Backend\Spec\NotificationRepository'
            );
        }

        return parent::setRepository($repository);
    }

    /**
     * Initialize query builder
     *
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    public function configureQueryBuilder(QueryBuilder $qb)
    {
        parent::configureQueryBuilder($qb);
        $qb->notDeleted();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function configurePage()
    {
        $this->addLayoutHandle('admin/notifications/grid');
        $this->setPageTitle(__('Admin Notifications'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Notifications'),
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
        return 'backend/admin/notifications';
    }

    /**
     * {@inheritDoc}
     */
    public function configureGrid()
    {
        $this->setDefaultOrder($this->idFieldName, 'desc');

        $col = new Datagrid\Column('created_at');
        $col->setLabel(__('Date Added'));
        $col->setWidth(12);
        $type = new ColumnType\DateTime(
            Carbon::DEFAULT_TO_STRING_FORMAT,
            \IntlDateFormatter::MEDIUM,
            \IntlDateFormatter::SHORT
        );
        $type->setOutputTimezone(
            $this->getServiceLocator()
                ->get('Zend\Authentication\AuthenticationService')
                ->getIdentity()
                ->getTimeZone()
        );
        $col->setType($type);
        $col->setSortable(true);
        $col->setFilterable(true)
            ->setFilter('daterange', 'between');
        $this->addColumn($col);

        $col = new Datagrid\Column('title');
        $col->setLabel(__('Title'));
        $col->setWidth(20);
        $col->addFormatter(new NotificationsGrid\TitleFormatter);
        $col->setSortable(true);
        $col->setFilterable(true)
            ->setFilter('text', 'like');
        $this->addColumn($col);

        $col = new Datagrid\Column('body');
        $col->setLabel(__('Message'));
        $col->setWidth(55);
        $col->setSortable(true);
        $col->setFilterable(true)
            ->setFilter('text', 'like');
        $this->addColumn($col);

        $updateAction = new Datagrid\ActionButton();
        $updateAction->setLabel('<i class="fa fa-check-circle-o"></i>');
        $updateAction->setAttribute('class', 'btn btn-primary btn-xs');
        $updateAction->setAttribute('title', __('Mark As Read'));
        $updateAction->setAttribute('data-toggle', 'tooltip');

        $updateAction->setAttribute(
            'href',
            url_to_route(
                $this->getRouteName(),
                [
                    'action' => 'mark-as-read',
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
        $action->setLabel(__('Mark as Read'));
        $action->setLink(
            url_to_route(
                $this->getRouteName(),
                [
                    'action' => 'group-action-handler',
                    'id'     => 'mark-as-read',
                ]
            )
        );
        $this->addGroupAction($action);

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
        parent::configureGrid();
    }
}
