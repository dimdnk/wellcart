<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Validator\File;


class Size extends
    \Zend\Validator\File\Size
{

    /**
     * @var bool
     */
    protected $allowEmpty = false;

    /**
     * @param boolean $allowEmpty
     *
     * @return Size
     */
    public function setAllowEmpty($allowEmpty)
    {
        $this->allowEmpty = (bool)$allowEmpty;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isValid($value, $file = null)
    {
        if ($this->isEmptyAllowed()
            && empty($value['tmp_name'])
            && empty($value['name'])
        ) {
            return true;
        }

        return parent::isValid($value, $file);
    }

    /**
     * @return bool
     */
    public function isEmptyAllowed()
    {
        return $this->allowEmpty;
    }
}
