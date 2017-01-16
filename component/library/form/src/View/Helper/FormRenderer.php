<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Form\View\Helper;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use Zend\Form\FieldsetInterface;
use Zend\Form\FormInterface;

class FormRenderer extends TwbBundleForm
{

    /**
     * Render form
     *
     * @param $form
     *
     * @return string
     */
    public function __invoke(FormInterface $form = null,
        $sFormLayout = self::LAYOUT_HORIZONTAL,
        $wrap = false
    ) {
        if ($form) {
            $form->prepare();
            $this->view->strokerFormPrepare($form->getName(), $form);
        }

        $html = '';
        $elements = $form->getIterator();

        if ($wrap) {
            $html .= $this->view->form()->openTag($form);
        }

        foreach ($elements as $element) {
            if (!$wrap
                && $element->getOption('action_bar_button') == true
            ) {
                continue;
            }
            $html .= $this->renderRow($element);
        }
        if ($wrap) {
            $html .= $this->view->form()->closeTag();
        }

        return $html;
    }

    protected function renderRow($element)
    {
        if ($element instanceof FieldsetInterface) {
            $html = $this->view->formCollection($element);
        } else {
            $html = $this->view->formRow($element);
        }

        return $html;
    }
}