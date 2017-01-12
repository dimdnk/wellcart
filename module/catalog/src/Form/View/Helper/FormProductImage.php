<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\View\Helper;

use WellCart\Catalog\Form\Element\ProductImage;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormFile;

class FormProductImage extends FormFile
{

    /**
     * @inheritdoc
     * @var $element ProductImage
     */
    public function render(ElementInterface $element)
    {
        $panel = '';
        $productImage = $element->getObject();
        $view = $this->getView();

        if ($productImage && $fullPath = $productImage->getFullPath()
        ) {
            $image = $view->plugin('image');
            $panel = sprintf(
                '<div class="panel-body">%s</div>',
                $image->thumbnail(
                    $view->resizeImage($fullPath)->thumb(75, 75)
                )
            );
        }
        $html = parent::render($element);

        return $panel . $html;
    }
}
