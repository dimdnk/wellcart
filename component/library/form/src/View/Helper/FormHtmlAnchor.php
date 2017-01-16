<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

class FormHtmlAnchor extends AbstractHelper
{

    /**
     * @var string
     */
    protected static $format = '<a href="%s" class="%s" target="%s"><i class="%s"></i> %s</a>';

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param  ElementInterface|null $element
     *
     * @return string|FormHtmlAnchor
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element);
    }

    /**
     * @see \Zend\Form\View\Helper\AbstractHelper::render()
     *
     * @param ElementInterface $oElement
     *
     * @return string
     */
    public function render(ElementInterface $oElement)
    {
        return
            sprintf(
                self::$format,
                $oElement->getLink(),
                $oElement->getClass(),
                $oElement->getTarget(),
                $oElement->getIcon(),
                $oElement->getText()
            );
    }
}