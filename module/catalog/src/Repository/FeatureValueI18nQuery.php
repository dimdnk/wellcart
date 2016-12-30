<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Repository;

use WellCart\Base\Spec\LocaleLanguageEntity;
use WellCart\ORM\QueryBuilder;

class FeatureValueI18nQuery extends QueryBuilder
{

    /**
     * @param LocaleLanguageEntity $language
     *
     * @return FeatureValueI18nQuery
     */
    public function filterByLanguage(LocaleLanguageEntity $language)
    {
        $alias = $this->getRootAliases()[0];
        $this->andWhere(
            $this->expr()->andX($alias . '.language = :language')
        );
        $this->setParameter('language', $language);

        return $this;
    }
}
