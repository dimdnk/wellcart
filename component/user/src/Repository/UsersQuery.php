<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Repository;

use WellCart\ORM\QueryBuilder;
use WellCart\User\Spec\UserEntity;

class UsersQuery extends QueryBuilder
{

    public function enabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.state = :state');
        $this->setParameter('state', UserEntity::STATE_ENABLED);

        return $this;
    }

    public function disabled()
    {
        $this->andWhere($this->getRootAliases()[0] . '.state = :state');
        $this->setParameter('state', UserEntity::STATE_DISABLED);

        return $this;
    }

    /**
     * Clean expired password reset tokens
     *
     * @param int $expirySeconds
     *
     * @return UsersQuery
     */
    public function cleanExpiredPasswordResetTokens($expirySeconds = 86400)
    {

        $period = new \DateTime(abs((int)$expirySeconds) . ' seconds ago');

        $this->update('WellCart\User\Entity\User', 'user');
        $this->set('user.passwordResetToken', ':password_reset_token');
        $this->setParameter('password_reset_token', null);

        $this->where('user.updatedAt <= :period');
        $this->setParameter('period', $period->format('Y-m-d H:i:s'));

        $this->getQuery()->execute();

        return $this;
    }
}
