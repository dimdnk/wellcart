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
     * {@inheritDoc}
     */
    protected function scope()
    {
        return 'admin_notifications';
    }

    /**
     * Initialize query builder
     *
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function configureQueryBuilder(QueryBuilder $qb)
    {
        parent::configureQueryBuilder($qb);
        $qb->notDeleted();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function configurePage()
    {
        $this->addLayoutHandle('admin/notifications/grid');
        $this->setPageTitle(__('Admin Notifications'))
            ->setBreadcrumbs(
                [
                    'list' => [
                        'label'  => __('Notifications'),
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
        return 'zfcadmin/admin/notifications';
    }

    /**
     * {@inheritDoc}
     */
    protected function configureGrid()
    {
        $this->setId('wellcart_user_admin_notifications_grid');

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

        $updateButton = new Datagrid\RowButton();
        $updateButton->setLabel('<i class="fa fa-check-circle-o"></i>');
        $updateButton->setAttribute('class', 'btn btn-primary btn-xs');
        $updateButton->setAttribute('title', __('Mark As Read'));
        $updateButton->setAttribute('data-toggle', 'tooltip');

        $updateButton->setAttribute(
            'href',
            url_to_route(
                $this->routeName(),
                [
                    'action' => 'mark-as-read',
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
        $action->setLabel(__('Mark as Read'));
        $action->setLink(
            url_to_route(
                $this->routeName(),
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
                $this->routeName(),
                [
                    'action' => 'group-action-handler',
                    'id'     => 'delete',
                ]
            )
        );
        $this->addGroupAction($action);
    }
}
