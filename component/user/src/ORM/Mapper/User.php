<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\ORM\Mapper;

use ZfcUserDoctrineORM\Mapper\User as AbstractMapper;

class User extends AbstractMapper
{

    public function setUserEntityClass($className)
    {
        $this->options->setUserEntityClass($className);

        return $this;
    }
}
