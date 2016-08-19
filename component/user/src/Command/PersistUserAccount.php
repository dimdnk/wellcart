<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Command;

use WellCart\User\Spec\UserEntity;

final class PersistUserAccount
{
    /**
     * @var UserEntity
     */
    private $user;
    /**
     * @var array
     */
    private $data;

    public function __construct(UserEntity $user, array $data)
    {
        $this->setUser($user);
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return UserEntity
     */
    public function getEntity(): UserEntity
    {
        return $this->getUser();
    }

    /**
     * @return UserEntity
     */
    public function getUser(): UserEntity
    {
        return $this->user;
    }

    /**
     * @param UserEntity $user
     *
     * @return PersistUserAccount
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
