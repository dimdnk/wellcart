<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\Element;

use Doctrine\Common\Collections\Collection;
use WellCart\ORM\Entity;

trait SetValueObjectTrait
{
    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        if ($value instanceof Collection) {
            $newValue = [];
            foreach ($value->getIterator() as $item) {
                if ($item instanceof Entity) {
                    $newValue[$item->getId()] = $item->getId();
                }
            }
            $value = $newValue;
        }
        if ($value instanceof Entity) {
            $value = $value->getId();
        }

        return parent::setValue($value);
    }


}