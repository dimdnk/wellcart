<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\Element;

use WellCart\Directory\Spec\CurrencyEntity;
use WellCart\Form\Element\Text;

class ProductPrice extends Text
{
    /**
     * @var CurrencyEntity
     */
    protected $currency;

    public function __construct(
        $name,
        array $options,
        CurrencyEntity $currency
    ) {
        $this->currency = $currency;
        $options['add-on-prepend'] = $this->currency->getSymbol();
        parent::__construct($name, $options);
    }

    public function setOptions($options)
    {
        $options['add-on-prepend'] = $this->currency->getSymbol();
        return parent::setOptions(
            $options
        );
    }

    public function setValue($value)
    {
        parent::setValue(doubleval($value));
        return $this;
    }


}
