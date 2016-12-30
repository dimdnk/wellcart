<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\AttributeRepository;
use WellCart\ORM\AbstractRepository;

class Attributes extends AbstractRepository implements AttributeRepository
{

    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toOptionsList(): array
    {
        $optionList = [];
        $options = $this->finder()->findAll();
        foreach ($options as $option) {
            $name = $option->getTranslations()->current()->getName();
            $optionList[$option->getId()] = $name;
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('attributesList')
        );
        return $optionList;
    }

    /**
     * @return AttributesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('AttributeEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return AttributesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new AttributesQuery($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);


        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('queryBuilder')
        );
        return $queryBuilder;
    }
}
