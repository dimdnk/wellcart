<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Spec;

use WellCart\ORM\QueryBuilder;
use WellCart\ORM\Repository;

interface ZoneRepository extends Repository
{

    /**
     * Creates a new QueryBuilder instance with predefined root alias.
     *
     * @return QueryBuilder
     */
    public function finder();

    /**
     * Creates a new QueryBuilder instance.
     *
     * @param  string     $alias
     * @param null|string $indexBy
     *
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null);

    /**
     * Retrieve options list
     *
     * @param int|CountryEntity $country
     * @param bool|false        $emptyOption
     *
     * @return array
     */
    public function toOptionsList($country, $emptyOption = false);

    /**
     * Find by country id
     *
     * @param $id
     *
     * @return array
     */
    public function findByCountry($id);

    /**
     * Get first country ID
     *
     * @return int
     * */
    public function getFirstCountryId();
}
