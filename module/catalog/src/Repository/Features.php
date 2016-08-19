<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Catalog\Spec\FeatureEntity;
use WellCart\Catalog\Spec\FeatureRepository;
use WellCart\ORM\AbstractRepository;

class Features extends AbstractRepository implements FeatureRepository
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
            compact('optionList')
        );
        return $optionList;
    }

    /**
     * Retrieve options list
     *
     * @return array
     */
    public function toGroupedOptionsList(): array
    {
        $optionList = [];
        $features = $this->finder()->findAll();
        foreach ($features as $feature) {
            $label = $feature->getTranslations()->first()->getName();
            $set = ['label' => $label, 'options' => []];
            /**
             * @var FeatureEntity $feature
             */
            $values = $feature->getValues();
            $valueOptions = [];
            if ($values->count()) {
                foreach ($values as $value) {
                    $valueOptions[$value->getId()] = $value->getTranslations()
                        ->first()->getName();
                }
                $set['options'] = $valueOptions;
            }
            $optionList[$feature->getId()] = $set;
        }

        $this->getEventManager()->trigger(
            __FUNCTION__ . '.post',
            $this,
            compact('optionList')
        );
        return $optionList;
    }


    /**
     * @return FeaturesQuery
     */
    public function finder()
    {
        $finder = $this->createQueryBuilder('FeatureEntity');
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            compact('finder')
        );
        return $finder;
    }

    /**
     * @return FeaturesQuery
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $queryBuilder = (new FeaturesQuery($this->_em))
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
