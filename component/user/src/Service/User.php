<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Service;

use WellCart\User\AbstractUser as UserEntity;
use Zend\Crypt\Password\Bcrypt;

class User extends \ZfcUser\Service\User
{
    /**
     * Update user password
     *
     * @param UserEntity $user
     * @param string     $password
     *
     * @return bool
     */
    public function updatePassword(UserEntity $user, $password)
    {
        $bcrypt = new Bcrypt;
        $bcrypt->setCost($this->getOptions()->getPasswordCost());
        $pass = $bcrypt->create($password);
        $user->setPassword($pass);

        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            ['user' => $user]
        );
        $this->getUserMapper()->update($user);
        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            ['user' => $user]
        );

        return true;
    }
}
