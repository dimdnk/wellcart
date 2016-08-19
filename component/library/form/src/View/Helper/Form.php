<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Form\View\Helper;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use Zend\Form\FormInterface;

class Form extends TwbBundleForm
{
    protected $currentLayout = self::LAYOUT_HORIZONTAL;

    /**
     * Generate an opening form tag
     *
     * @param  null|FormInterface $oForm
     *
     * @return string
     */
    public function openTag(FormInterface $oForm = null)
    {
        if ($oForm) {
            $sFormLayout = $this->currentLayout;
            //Set form layout class
            if (is_string($sFormLayout)) {
                $sLayoutClass = 'form-' . $sFormLayout;
                if ($sFormClass = $oForm->getAttribute('class')) {
                    if (!preg_match(
                        '/(\s|^)' . preg_quote($sLayoutClass, '/') . '(\s|$)/',
                        $sFormClass
                    )
                    ) {
                        $oForm->setAttribute(
                            'class', trim($sFormClass . ' ' . $sLayoutClass)
                        );
                    }
                } else {
                    $oForm->setAttribute('class', $sLayoutClass);
                }
            }

            //Set form role
            if (!$oForm->getAttribute('role')) {
                $oForm->setAttribute('role', 'form');
            }
            $action = $oForm->getAttribute('action');
            if ($action === null) {
                $oForm->setAttribute(
                    'action',
                    url_to_route(
                        null, array(), array(), true
                    )
                );
            }
        }
        return parent::openTag($oForm);
    }


    /**
     * @see \Zend\Form\View\Helper\Form::__invoke()
     *
     * @param \Zend\Form\FormInterface $oForm
     * @param string                   $sFormLayout
     *
     * @return \TwbBundle\Form\View\Helper\TwbBundleForm|string
     */
    public function __invoke(\Zend\Form\FormInterface $oForm = null,
        $sFormLayout = self::LAYOUT_HORIZONTAL
    ) {
        if ($sFormLayout) {
            $this->currentLayout = $sFormLayout;
        }

        return parent::__invoke($oForm, $sFormLayout);
    }
}