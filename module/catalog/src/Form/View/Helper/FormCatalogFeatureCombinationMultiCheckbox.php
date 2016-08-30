<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormMultiCheckbox;

class FormCatalogFeatureCombinationMultiCheckbox extends FormMultiCheckbox
{
    /**
     * @inheritdoc
     */
    public function render(ElementInterface $element)
    {
        return parent::render($element);
    }
}
