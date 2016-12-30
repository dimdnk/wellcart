<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ORM;

class DefaultRepository extends AbstractRepository
{
    /**
     * {@inheritDoc}
     */
    public function finder()
    {
        return $this->createQueryBuilder('FindEntity');
    }
}