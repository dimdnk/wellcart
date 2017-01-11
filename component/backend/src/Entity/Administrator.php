<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Entity;

use WellCart\Backend\Spec\AdministratorEntity;
use WellCart\User\AbstractUser;
use WellCart\User\Spec\UserEntity;

class Administrator extends AbstractUser implements AdministratorEntity
{
    /**
     * @param string $emailConfirmationToken
     *
     * @return UserEntity
     */
    public function setEmailConfirmationToken($emailConfirmationToken
    ): UserEntity
    {
        $this->emailConfirmationToken = null;
        return $this;
    }
}
