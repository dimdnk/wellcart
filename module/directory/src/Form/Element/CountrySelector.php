<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Form\Element;

use WellCart\Form\Element\Select;

class CountrySelector extends Select
{

    /**
     * @param null  $name
     * @param array $options
     * @param array $countryOptions
     */
    public function __construct(
        $name = null,
        $options = [],
        array $countryOptions = []
    ) {
        parent::__construct($name, $options);
        if ($countryOptions) {
            $this->setEmptyOption('');
            $this->setValueOptions($countryOptions);
        }
        $this->disableValidator();
    }
}
