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

class ProductI18nQuery extends QueryBuilder
{

    /**
     * Filter by language
     *
     * @param LocaleLanguageEntity $language
     *
     * @return ProductI18nQuery
     */
    public function filterByLanguage(LocaleLanguageEntity $language)
    {
        $alias = $this->getRootAliases()[0];
        $this->andWhere($alias . '.language = :language');
        $this->setParameter('language', $language);
        return $this;
    }

    public function withVariants()
    {
        $this->withProduct();
        $this->innerJoin('p.variants', 'variants');
        return $this;
    }

    public function withProduct()
    {
        $this->innerJoin($this->getRootAliases()[0] . '.product', 'p');
        return $this;
    }
}
