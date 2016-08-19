<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Hydrator;

use WellCart\Hydrator\DoctrineObject as ObjectHydrator;

class ProductHydrator extends ObjectHydrator
{
    /**
     * @inheritDoc
     */
    public function extract($object)
    {
        return parent::extract($object);
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array  $data
     * @param  object $object
     *
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        return parent::hydrate($data, $object);
    }
}
