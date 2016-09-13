<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog\Form\Element;

use Doctrine\Common\Collections\Collection;
use WellCart\Catalog\Entity\Category;
use WellCart\Form\Element\MultiCheckbox;

class CategoryMultiCheckbox extends MultiCheckbox
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes
        = [
            'type' => 'catalogCategoryMultiCheckbox',
        ];

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        if ($value instanceof Collection) {
            $newValue = [];
            foreach ($value->getIterator() as $item) {
                if ($item instanceof Category) {
                    $id = $item->getId();
                    $newValue[$id] = $id;
                }
            }
            $value = $newValue;
        }
        if ($value instanceof Category) {
            $value = $value->getId();
        }

        return parent::setValue($value);
    }
}