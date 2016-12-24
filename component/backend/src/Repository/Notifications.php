<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Repository;

use Doctrine\DBAL\Connection;
use WellCart\Backend\Spec\NotificationRepository;
use WellCart\ORM\AbstractRepository;
use WellCart\ORM\ExpectedResultException;

class Notifications extends AbstractRepository implements NotificationRepository
{

    /**
     * @return NotificationsQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('NotificationEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return NotificationsQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new NotificationsQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );
        return $queryBuilder;
    }

    /**
     * Mass mark as read
     *
     * @param array $ids
     * @param bool  $useException
     *
     * @return array
     * @throws ExpectedResultException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function performGroupMarkAsRead(
        array $ids,
        $useException = false
    ) {
        $result = [];
        $ids = array_map('abs', array_map('intval', $ids));

        if (empty($ids)) {
            return [];
        }
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.pre',
            $this,
            compact('ids')
        );
        $this->connection()->executeQuery(
            'UPDATE admin_notifications SET is_read = ? WHERE notification_id IN(?)',
            ['1', $ids],
            [
                \PDO::PARAM_INT,
                Connection::PARAM_INT_ARRAY
            ]
        );

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('ids')
        );

        if ($useException) {
            throw new ExpectedResultException(
                'Messages successfully marked as read.'
            );
        }
        return $result;
    }
}
