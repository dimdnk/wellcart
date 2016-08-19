<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Spec;

use WellCart\ORM\Repository;

interface ProductTemplateI18nRepository extends Repository
{
    public function finder();

    public function createQueryBuilder($alias, $indexBy = null);

    /**
     * Find group by id
     *
     * @param $id
     *
     * @return null|ProductTemplateEntity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findProductTemplateById($id);

    /**
     * Create new product entity
     *
     * @return ProductTemplateEntity
     */
    public function createProductTemplateEntity();

    /**
     * Perform group delete objects
     *
     * @param array $ids
     * @param bool  $useException
     *
     * @return mixed
     */
    public function performGroupDeleteProductTemplates(
        array $ids,
        $useException = false
    );

    /**
     * @inheritdoc
     */
    public function toOptionsList(): array;

    /**
     * @return array
     */
    public function findAllTemplateIds(): array;
}
