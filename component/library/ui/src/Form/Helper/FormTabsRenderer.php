<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Form\Helper;

use WellCart\Base\Exception;
use WellCart\Form\Form as AbstractForm;
use WellCart\Ui\Form\TabbedForm;
use WellCart\Utility\Arr;
use Zend\Form\ElementInterface;
use Zend\Form\FieldsetInterface;
use Zend\View\Helper\AbstractHtmlElement;

class FormTabsRenderer extends AbstractHtmlElement
{

    /**
     * Render form
     *
     * @param TabbedForm $form
     *
     * @return string
     */
    public function __invoke(AbstractForm $form, $wrap = false)
    {
        $form->prepare();
        $view = $this->getView();
        $formName = $form->getName();
        $view->strokerFormPrepare($formName, $form);

        $menu = $this->getTabMenuLinks($form);
        $html = $this->navTabs($menu, $form->getNavTabsAttributes());
        if ($wrap) {
            $html .= $this->view->form()->openTag($form);
        }


        $activeClass = ' active';
        $html .= '<div class="tab-content">';
        foreach ($form->getTabs() as $tab) {
            $tabId = 'tab-' . $formName . '-' . $tab->getId();
            $html .= '<div id="' . $tabId . '"  role="tabpanel" class="tab-pane'
                . $activeClass
                . '">';
            $activeClass = '';

            $html .= "<div class='form-body'>";

            foreach ($tab as $elements) {
                $html .= $this->renderRow($elements);
            }
            $html .= "</div>\n</div>\n";
        }
        $html .= "<template class='tab-pane-template'></template>\n";
        $html .= "</div>\n";

        if ($wrap) {
            $html .= $this->view->form()->closeTag();
        }

        return $html;
    }

    /**
     * @param $form
     *
     * @return array
     */
    public function getTabMenuLinks($form)
    {
        $formName = $form->getName();
        $tabs = $form->getTabs();

        $menuLinks = [];
        foreach ($tabs as $tab) {
            $id = $tab->getId();
            $label = $tab->getLabel();
            $attr = $tab->getAttributes();

            $attr = Arr::merge(
                [
                    'data-toggle' => 'tab',
                    'href'        => '#tab-' . $formName . '-' . $id,
                ],
                $attr
            );
            if (!count($menuLinks)) {
                $attr['class'] = 'active';
            }

            $menuLinks[$formName . '-' . $id] = sprintf(
                "<a %s>%s</a>", $this->htmlAttribs($attr), $label
            );
        }

        return $menuLinks;
    }


    /**
     * Generates a 'nav tabs' element.
     *
     * @param  array $items   Array with the elements of the list
     * @param  array $attribs Attributes for the ol/ul tag.
     *
     * @throws Exception\InvalidArgumentException
     * @return string The list XHTML.
     */
    public function navTabs(array $items, $attribs = false)
    {
        if (empty($items)) {
            throw new Exception\InvalidArgumentException(
                sprintf(
                    '$items array can not be empty in %s',
                    __METHOD__
                )
            );
        }

        $list = '';
        $activeClass = ' class="active"';
        foreach ($items as $item) {
            if (!is_array($item)) {
                $list .= '<li role="presentation" ' . $activeClass . '>' . $item
                    . '</li>' . PHP_EOL;
                $activeClass = '';
            } else {
                $itemLength = 5 + strlen(PHP_EOL);
                if ($itemLength < strlen($list)) {
                    $list = substr($list, 0, strlen($list) - $itemLength)
                        . $this->navTabs($item, $attribs) . '</li>' . PHP_EOL;
                } else {
                    $list .= '<li role="presentation">' . $this->navTabs(
                            $item, $attribs
                        ) . '</li>'
                        . PHP_EOL;
                }
            }
        }

        if ($attribs) {
            $attribs = $this->htmlAttribs($attribs);
        } else {
            $attribs = '';
        }

        $tag = 'ul';

        return '<' . $tag . $attribs . ' role="tablist">' . PHP_EOL . $list
            . '</' . $tag . '>'
            . PHP_EOL;
    }


    /**
     * @param               $element
     * @param \Closure|null $excluder
     *
     * @return string
     */
    public function renderRow($element, \Closure $excluder = null): string
    {
        $elements = [];
        if ($element instanceof ElementInterface) {
            $elements[] = $element;
        } else {
            $elements = $element;
        }

        if ($excluder) {
            foreach ($elements as $idx => $element) {
                if ($excluder($element) === false) {
                    unset($elements[$idx]);
                }
            }
        }

        $html = '';
        foreach ($elements as $element) {
            if ($element instanceof FieldsetInterface) {
                $html .= $this->view->formCollection($element);
            } else {
                $html .= $this->view->formRow($element);
            }
        }

        return $html;
    }
}