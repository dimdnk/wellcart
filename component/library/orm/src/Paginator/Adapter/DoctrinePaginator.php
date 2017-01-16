<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\ORM\Paginator\Adapter;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as AbstractDoctrinePaginator;

class DoctrinePaginator extends AbstractDoctrinePaginator
{

    public function getQueryBuilder()
    {
        return $this->getPaginator()->getQueryBuilder();
    }
}